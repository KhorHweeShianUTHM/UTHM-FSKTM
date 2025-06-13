package hospital;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.File;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;
import java.util.Scanner;

// Abstract class
abstract class AbstractProfile {
    protected static final String FILE_NAME = "users.txt"; // Ensure this file exists in the correct directory

    // Abstract method to define a profile menu
    public abstract void userProfileMenu(Scanner scan, String username);
}

// Concrete class extending AbstractProfile
public class Profile extends AbstractProfile {

    @Override
    public void userProfileMenu(Scanner scan, String username) {
        System.out.println("\n=== Profile ===");
        System.out.println("1. Update Own User Profile");
        System.out.println("2. Remove User Profile");
        System.out.println("3. Search and Display User Profile");
        System.out.println("4. Exit");
        System.out.print("Enter your choice: ");
        int profileChoice = scan.nextInt();
        scan.nextLine(); // Consume newline

        switch (profileChoice) {
            case 1:
                updateUser(scan, username);
                userProfileMenu(scan, username);
                break;
            case 2:
                removeUser(scan);
                userProfileMenu(scan, username);
                break;
            case 3:
                searchAndDisplayUser(scan);
                userProfileMenu(scan, username);
                break;
            case 4:
                System.out.println("Exiting...\n");
                return;
            default:
                System.out.println("\u001B[31mInvalid choice. Please try again.\u001B[0m\n"); // red color text
        }
    }

    private void updateUser(Scanner scan, String username) {
        try {
            File file = new File(FILE_NAME);
            BufferedReader reader = new BufferedReader(new FileReader(file));
            StringBuilder fileContent = new StringBuilder();
            String line;
            boolean userFound = false;

            System.out.print("Enter your ID to update your profile: ");
            String inputID = scan.nextLine();

            while ((line = reader.readLine()) != null) {
                String[] userDetails = line.split(", ");
                if (userDetails[0].equals(inputID) && userDetails[1].equals(username)) {
                    userFound = true;
                    System.out.println("\n=== User Profile ===");
                    System.out.println("1. ID: " + userDetails[0]);
                    System.out.println("2. Username: " + userDetails[1]);
                    System.out.println("3. Password: " + userDetails[2]);
                    System.out.println("4. Role: " + userDetails[3]);
                    System.out.println("5. Department: " + userDetails[4]);

                    System.out.print("Enter the number to update: ");
                    int detailChoice = scan.nextInt();
                    scan.nextLine(); // Consume newline
                    String newValue = "";

                    switch (detailChoice) {
                        case 1:
                            System.out.print("Enter new ID: ");
                            newValue = scan.nextLine();
                            userDetails[0] = newValue;
                            break;
                        case 2:
                            System.out.print("Enter new Username: ");
                            newValue = scan.nextLine();
                            userDetails[1] = newValue;
                            break;
                        case 3:
                            System.out.print("Enter new Password: ");
                            newValue = scan.nextLine();
                            userDetails[2] = newValue;
                            break;
                        case 4:
                            while (true) {
                                System.out.println("1. Doctor");
                                System.out.println("2. Staff");
                                System.out.print("Enter new Role: ");
                                int role = scan.nextInt();
                                scan.nextLine(); // Consume newline

                                if (role == 1) {
                                    newValue = "Doctor";
                                    userDetails[3] = newValue;
                                    break;
                                } else if (role == 2) {
                                    newValue = "Staff";
                                    userDetails[3] = newValue;
                                    break;
                                } else {
                                    System.out.println("\u001B[31mInvalid choice. Please select [1-2].\u001B[0m\n"); // red color text
                                }
                            }
                            break;
                        case 5:
                            while (true) {
                                System.out.println("1. Cardiology");
                                System.out.println("2. Optic");
                                System.out.println("3. Radiology");
                                System.out.println("4. Surgery");
                                System.out.println("5. Pathology");
                                System.out.println("6. Physiotherapy");
                                System.out.println("7. Dermatology");
                                System.out.println("8. Psychiatry");
                                System.out.println("9. Pharmacy");
                                System.out.println("10. Lab");
                                System.out.print("Enter new Department: ");
                                int department = scan.nextInt();
                                scan.nextLine(); // Consume newline

                                if (department >= 1 && department <= 10) {
                                    String[] departments = {
                                        "Cardiology", "Optic", "Radiology", "Surgery", 
                                        "Pathology", "Physiotherapy", "Dermatology", 
                                        "Psychiatry", "Pharmacy", "Lab"
                                    };
                                    newValue = departments[department - 1];
                                    userDetails[4] = newValue;
                                    break;
                                } else {
                                    System.out.println("\u001B[31mInvalid choice. Please select [1-10].\u001B[0m\n"); // red color text
                                }
                            }
                            break;
                        default:
                            System.out.println("\u001B[31mInvalid choice. Please try again.\u001B[0m\n"); // red color text
                            return;
                    }

                    System.out.print("Are you sure you want to save the changes? (y/n): ");
                    String confirmation = scan.nextLine();
                    if (confirmation.equalsIgnoreCase("y")) {
                        line = String.join(", ", userDetails); // Update the line with new values
                        System.out.println("\u001B[32mChanges saved successfully!\u001B[0m\n"); // green color text
                    } else {
                        System.out.println("\u001B[31mChanges discarded.\u001B[0m\n"); // red color text
                    }
                }
                fileContent.append(line).append("\n"); // Add (updated or not) line to the file content
            }
            reader.close();

            if (userFound) {
                BufferedWriter writer = new BufferedWriter(new FileWriter(file));
                writer.write(fileContent.toString());
                writer.close();
            } else {
                System.out.println("\u001B[31mUser profile not found.\u001B[0m\n"); // red color text
            }
        } catch (IOException e) {
            System.out.println("\u001B[31mError updating user profile: " + e.getMessage() + "\u001B[0m\n"); // red color text
        }
    }

    private void removeUser(Scanner scan) {
        try {
            File file = new File(FILE_NAME);
            BufferedReader reader = new BufferedReader(new FileReader(file));
            StringBuilder fileContent = new StringBuilder();
            String line;
            boolean userFound = false;

            System.out.print("Enter the ID of the profile to delete: ");
            String inputID = scan.nextLine();

            while ((line = reader.readLine()) != null) {
                String[] userDetails = line.split(", ");
                if (userDetails[0].equals(inputID)) {
                    userFound = true;
                    System.out.println("\u001B[32mData has been removed successfully.\u001B[0m\n"); // green color text
                    continue;
                }
                fileContent.append(line).append("\n");
            }
            reader.close();

            if (userFound) {
                BufferedWriter writer = new BufferedWriter(new FileWriter(file));
                writer.write(fileContent.toString());
                writer.close();
            } else {
                System.out.println("\u001B[31mProfile not found.\u001B[0m\n"); // red color text
            }
        } catch (IOException e) {
            System.out.println("\u001B[31mError deleting user profile: " + e.getMessage() + "\u001B[0m\n"); // red color text
        }
    }

    private void searchAndDisplayUser(Scanner scan) {
        try {
            File file = new File(FILE_NAME);
            BufferedReader reader = new BufferedReader(new FileReader(file));
            String line;
            boolean userFound = false;

            System.out.print("Enter the ID of the profile to search: ");
            String inputID = scan.nextLine();

            while ((line = reader.readLine()) != null) {
                String[] userDetails = line.split(", ");
                if (userDetails[0].equals(inputID)) {
                    userFound = true;
                    System.out.println("\n=== Profile Details ===");
                    System.out.println("ID: " + userDetails[0]);
                    System.out.println("Username: " + userDetails[1]);
                    System.out.println("Password: " + userDetails[2]);
                    System.out.println("Role: " + userDetails[3]);
                    System.out.println("Department: " + userDetails[4]);
                    System.out.println("");
                    break;
                }
            }
            reader.close();

            if (!userFound) {
                System.out.println("\u001B[31mProfile not found.\u001B[0m\n"); // red color text
            }
        } catch (IOException e) {
            System.out.println("\u001B[31mError searching user profile: " + e.getMessage() + "\u001B[0m\n"); // red color text
        }
    }
}