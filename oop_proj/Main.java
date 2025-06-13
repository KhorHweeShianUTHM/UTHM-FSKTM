package hospital;

import java.io.*;
import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;
import java.util.Scanner;

public class Main {

    private static final String FILE_NAME = "users.txt";
    
    // Abstract
    // Declared as an Abstract class
    abstract class UserOperation {
        protected Scanner scan;
        protected String id;
        protected String username;
        protected String password;
        protected int role;
        protected int department;
        
        // Constructor
        public UserOperation(Scanner scan, String id, String username, String password, int role, int department) {
            this.scan = scan;
            this.id = id;
            this.username = username;
            this.password = password;
            this.role = role;
            this.department = department;
        }
        
        // Encapsulation
        // Getters and Setters methods
        public String getId() {
            return id;
        }

        public void setId(String id) {
            this.id = id;
        }
        
        public String getUsername() {
            return username;
        }

        public void setUsername(String username) {
            this.username = username;
        }
        
        public String getPassword() {
            return password;
        }

        public void setPassword(String password) {
            this.password = password;
        }
        
        public int getRole() {
            return role;
        }

        public void setRole(int role) {
            this.role = role;
        }
        
        public int getDepartment() {
            return department;
        }

        public void setDepartment(int department) {
            this.department = department; 
        }
        
        // Abstract
        // Declared as an Abstract method
        public abstract void signUp();
        public abstract String[] login();
    }

    // Inheritance
    // LoginSignup class inherits from UserOperation abstract class
    public class LoginSignup extends UserOperation {
        
        // Constructor
        public LoginSignup(Scanner scan, String id, String username, String password, int role, int department) {
            super(scan, id, username, password, role, department); // Invoke the Constructor of parent class
        }
        
        // Overriding methods from UserOperation superclass
        @Override
        public void signUp() {
            System.out.println("\n=== Sign Up ===");
            
            // ID
            System.out.print("Enter your ID (e.g. S001): ");
            id = scan.nextLine();
            
            // Validate ID format
            while (!id.matches("[A-Z]\\d{3}")) {
                System.out.println("\u001B[31mInvalid ID format. Please enter an ID in the format 'S001'.\u001B[0m\n"); // red color text
                System.out.print("Enter your ID (e.g. S001): ");
                id = scan.nextLine();
            }
            
            // Username
            System.out.print("Enter your username: ");
            username = scan.nextLine();
            
            // Validate Non-Empty Username
            while (username.trim().isEmpty()) {
                System.out.println("\u001B[31mUsername cannot be empty. Please enter a valid username.\u001B[0m\n"); // red color text
                System.out.print("Enter your username: ");
                username = scan.nextLine();
            }
            
            // Password
            System.out.print("Enter your password: ");
            password = scan.nextLine();
            
            // Validate Password Strength
            while (password.length() < 6 || !password.matches(".*\\d.*") || !password.matches(".*[a-zA-Z].*")) {
                System.out.println("\u001B[31mPassword must be at least 6 characters long, contain letters and numbers.\u001B[0m\n"); // red color text
                System.out.print("Enter your password: ");
                password = scan.nextLine();
            }
            
            // Roles
            System.out.println("1. Doctor");
            System.out.println("2. Staff");
            String roleString = "";
            
            // Loop until user enters a valid number
            while (true) {
                System.out.print("Select your role: ");
                role = scan.nextInt();
                scan.nextLine(); // Consume newline
                if (role == 1) {
                    roleString = "Doctor";
                    break;
                } else if (role == 2) {
                    roleString = "Staff";
                    break;
                } else {
                    System.out.println("\u001B[31mInvalid choice. Please select [1-2].\u001B[0m\n"); // red color text
                }
            }
            
            // Departments
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
            String departmentString = "";
            
            // Loop until user enters a valid number
            while (true) {
                System.out.print("Enter your department: ");
                department = scan.nextInt();
                scan.nextLine(); // Consume newline
                if (department >= 1 && department <= 10) {
                    String[] departments = {"Cardiology", "Optic", "Radiology", "Surgery", "Pathology", 
                                            "Physiotherapy", "Dermatology", "Psychiatry", "Pharmacy", "Lab"};
                    departmentString = departments[department - 1];
                    break;
                } else {
                    System.out.println("\u001B[31mInvalid choice. Please select [1-10].\u001B[0m\n"); // red color text
                }
            }
            
            // Store user data in the exe file
            try (BufferedWriter writer = new BufferedWriter(new FileWriter(FILE_NAME, true))) {
                writer.write(id + ", " + username + ", " + password + ", " + roleString + ", " + departmentString);
                writer.newLine();
                System.out.println("\u001B[32mSign up successful!\u001B[0m\n"); // green color text
            } catch (IOException e) {
                System.out.println("\u001B[31mError writing file: " + e.getMessage() + "\u001B[0m\n"); // red color text
            }
        }
        
        // Overriding methods from UserOperation superclass
        @Override
        public String[] login() {
            System.out.println("\n=== Login ===");
            
            // ID
            System.out.print("Enter your ID (e.g. S001): ");
            id = scan.nextLine();
            
            // Validate ID format
            while (!id.matches("[A-Z]\\d{3}")) {
                System.out.println("\u001B[31mInvalid ID format. Please enter an ID in the format 'S001'.\u001B[0m\n"); // red color text
                System.out.print("Enter your ID (e.g. S001): ");
                id = scan.nextLine();
            }
            
            // Password
            System.out.print("Enter your password: ");
            password = scan.nextLine();
            
            // Validate Non-Empty Password
            while (password.trim().isEmpty()) {
                System.out.println("\u001B[31mPassword cannot be empty. Please enter a valid password.\u001B[0m\n"); // red color text
                System.out.print("Enter your password: ");
                password = scan.nextLine();
            }
            
            // Check if the user exists in the file
            try (BufferedReader reader = new BufferedReader(new FileReader(FILE_NAME))) {
                String line;
                while ((line = reader.readLine()) != null) {
                    String[] userDetails = line.split(", ");
                    String storedId = userDetails[0];
                    String storedPassword = userDetails[2];

                    if (storedId.equals(id) && storedPassword.equals(password)) {
                        System.out.println("\u001B[32mLogin successful!\u001B[0m\n"); // green color text
                        return userDetails;
                    }
                }
                System.out.println("\u001B[31mInvalid ID or password. Please try again.\u001B[0m\n"); // red color text
            } catch (IOException e) {
                System.out.println("\u001B[31mError reading file: " + e.getMessage() + "\u001B[0m\n"); // red color text
            }
            return null;
        }
    }
    
    private static void homePage(String username) {
        Scanner scan = new Scanner(System.in);
        Profile profile = new Profile();
        Appointment appointment = new Appointment();
            
        LocalDateTime now = LocalDateTime.now();
        DateTimeFormatter formatter = DateTimeFormatter.ofPattern("EEEE, d MMMM, yyyy h:mm:ss a");
            
        while (true) {
            System.out.println("=== Home: Staff & Doctor Management System ===");
            System.out.println("Hello, " + username + ".");
            System.out.println("Today is " + now.format(formatter));
            System.out.println("1. User Profile");
            System.out.println("2. Appointment");
            System.out.println("3. Logout");
            System.out.print("Select a choice: ");
            int choice = scan.nextInt();
            scan.nextLine(); // Consume newline
                
            if (choice == 1) {
                profile.userProfileMenu(scan, username);
            } else if (choice == 2) {
                appointment.appointmentMenu(scan, username);
            } else if (choice == 3) {
                System.out.println("Logging out...\n");
                break;
            } else {
                System.out.println("\u001B[31mInvalid choice. Please try again.\u001B[0m\n"); // red color text
            }
        }
    }

    public static void main(String[] args) {
        Scanner scan = new Scanner(System.in);
        String id = null;
        String username = null;
        String password = null;
        int role = 0;
        int department = 0;
        
        Main main = new Main();
        
        // Polymorphism
        // The operation variable is declared as type UserOperation but holds an instance of the subclass LoginSignup
        UserOperation operation = main.new LoginSignup(scan, id, username, password, role, department);

        while (true) {
            System.out.println("=== Welcome: Staff & Doctor Management System ===");
            System.out.println("1. Sign Up");
            System.out.println("2. Login");
            System.out.println("3. End Program");
            System.out.print("Please select an option: ");
            int choice = scan.nextInt();
            scan.nextLine(); // Consume newline

            if (choice == 1) {
                // Polymorphism
                // The signUp method is called on the operation reference, 
                // which dynamically invokes the signUp method of the LoginSignup class at runtime
                operation.signUp();
                
            } else if (choice == 2) {
                // Polymorphism
                // The login method is called on the operation reference, 
                // which dynamically invokes the login method of the LoginSignup class at runtime
                String[] loginUser = operation.login();
                
                if (loginUser != null) {
                    homePage(loginUser[1]);
                }
            } else if (choice == 3) {
                System.out.println("Exiting Program...\n");
                break;
            } else {
                System.out.println("\u001B[31mInvalid choice. Please try again.\u001B[0m\n"); // red color text
            }
        }
        scan.close();
    }
}