package hospital;

import java.io.*;
import java.util.ArrayList;
import java.util.Scanner;

//Abstract Class
abstract class AbstractAppointment{
	//This creates a new instance of ArrayList with the default constructor.
	//Intended to hold all the appointments managed in the program.
	protected ArrayList<String> appointments = new ArrayList<>();
	
	//Abstract methods to enforce implementation
	public abstract void loadAppointment();
	public abstract void saveAppointment();
	public abstract void displayAppointment();
	
	//Shared functionality for appointments
	public void addAppointment(String appointment) {
		appointments.add(appointment);
	}
}

public class Appointment extends AbstractAppointment{
	
    private static final String FILE_NAME = "appointments.txt";
    
    // add a Constructor
    public Appointment() {
        super(); // We initialize from parent
        loadAppointment();
    }
    
    public void appointmentMenu(Scanner scan, String username){
        System.out.println("\n=== Appointment ===");
        System.out.println("1. Create an Appointment");
        System.out.println("2. Remove an Appointment");
        System.out.println("3. Update Patient's Appointment");
        System.out.println("4. Search for Patient's Appointment");
        System.out.println("5. Display All Appointment");
        System.out.println("6. Exit");
        
        System.out.print("Enter your choice: ");
        int appointmentChoice = scan.nextInt();
        scan.nextLine(); // Consume newline
                
        switch (appointmentChoice) {
            case 1:
                createAppointment(scan);
                appointmentMenu(scan, username);
                break;
            case 2:
                removeAppointment(scan);
                appointmentMenu(scan, username);
                break;
            case 3:
                updateAppointment(scan);
                appointmentMenu(scan, username);
                break;
            case 4:
                searchAppointment(scan);
                appointmentMenu(scan, username);
                break;
            case 5:
                displayAppointment();
                appointmentMenu(scan, username);
                break;
            case 6:
                System.out.println("Exiting...\n");
                return;
            default:
                System.out.println("\u001B[31mInvalid choice. Please try again.\u001B[0m\n"); // red color text
            }
        }
    
    // Load appointments from file
    @Override
    public void loadAppointment() {
    	try(BufferedReader reader = new BufferedReader(new FileReader(FILE_NAME))){
    		String line;
    		while ((line = reader.readLine()) != null) {
    			appointments.add(line);
    		}
    	} catch (IOException e) {
    		System.out.println("\u001B[31mNo existing appointment file found. Starting fresh.\u001B[0m\n");
    	}
    }
    
    // Save appointments to file
    @Override
    public void saveAppointment() {
    	try(BufferedWriter writer = new BufferedWriter(new FileWriter(FILE_NAME))){
    		for(String appointment : appointments) {
    			writer.write(appointment);
    			writer.newLine();
    		}
    	} catch (IOException e) {
    		System.out.println("\u001B[31mError saving appointments.\u001B[0m\n");
    	}
    }
    
    // Display all appointments
    @Override
    public void displayAppointment() {
    	if (appointments.isEmpty()) {
    		System.out.println("\u001B[31mNo appointments available.\u001B[0m\n");
    	} else {
    		System.out.println ("\n=== Appointments ===");
    		for (int i = 0; i < appointments.size(); i++) {
    			System.out.println((i+1) + ". " + appointments.get(i));
    		}
    	}
    }
    
 // Create a new appointment
    private void createAppointment(Scanner scan) {
        System.out.print("Enter patient's name: ");
        String patientName = scan.nextLine();

        System.out.print("Enter appointment details: ");
        String patientDetails = scan.nextLine();

        System.out.print("Enter appointment date (e.g., 2025-01-15): ");
        String appointmentDate = scan.nextLine();

        System.out.print("Enter appointment time (e.g., 14:30): ");
        String appointmentTime = scan.nextLine();

        // Combine all details into a single appointment string
        String appointment = "Patient: " + patientName + ", Details: " + patientDetails +
                             ", Date: " + appointmentDate + ", Time: " + appointmentTime;

        appointments.add(appointment);
        saveAppointment();

        System.out.println("\u001B[32mAppointment created successfully.\u001B[0m"); // green color text
    }


    // Remove an appointment
    private void removeAppointment(Scanner scan) {
        if (appointments.isEmpty()) {
            System.out.println("\u001B[31mNo appointments to remove.\u001B[0m"); // red color text
            return;
        }
        displayAppointment();
        
        System.out.print("Enter the appointment number to remove: ");
        int index = scan.nextInt() - 1;
        scan.nextLine(); // Clear the buffer
        
        if (index >= 0 && index < appointments.size()) {
            appointments.remove(index);
            saveAppointment();
            System.out.println("\u001B[32mAppointment removed successfully.\u001B[0m"); // green color text
        } else {
            System.out.println("\u001B[31mInvalid appointment number.\u001B[0m"); // red color text
        }
    } 

    // Update an existing appointment
    private void updateAppointment(Scanner scan) {
        if (appointments.isEmpty()) {
            System.out.println("\u001B[31mNo appointments to update.\u001B[0m"); // red color text
            return;
        }
        displayAppointment();
        
        System.out.print("Enter the appointment number to update: ");
        int index = scan.nextInt() - 1;
        scan.nextLine(); // Clear the buffer
        
        if (index >= 0 && index < appointments.size()) {
            System.out.print("Enter new appointment details: ");
            String newDetails = scan.nextLine();
            String updatedAppointment = "Patient: " + appointments.get(index).split(",")[0].split(":")[1].trim() + ", Details: " + newDetails;
            appointments.set(index, updatedAppointment);
            saveAppointment();
            
            System.out.println("\u001B[32mAppointment updated successfully.\u001B[0m"); // green color text
        } else {
            System.out.println("\u001B[31mInvalid appointment number.\u001B[0m"); // red color text
        }
    }

    // Search for appointments
    private void searchAppointment(Scanner scan) {
        if (appointments.isEmpty()) {
            System.out.println("\u001B[31mNo appointments to search.\u001B[0m"); // red color text
            return;
        }
        System.out.print("Enter patient's name for searching: ");
        String term = scan.nextLine().toLowerCase();
        boolean found = false;

        for (String appointment : appointments) {
            if (appointment.toLowerCase().contains(term)) {
                System.out.println(appointment);
                found = true;
            }
        }

        if (!found) {
            System.out.println("\u001B[31mNo appointments found matching the search term.\u001B[0m"); // red color text
        }
    }

}