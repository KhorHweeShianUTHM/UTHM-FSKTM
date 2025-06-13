#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <ctype.h>

// Structure to represent an Employee
typedef struct Employee {
    int id;
    char name[50];
    char nric[20];
    char department[50];
    float salary;
    struct Employee* next;
} Employee;

Employee* head = NULL;

void addEmployee();
void updateEmployee();
void deleteEmployee();
void displayEmployees();
void searchEmployee();
void sortEmployees();
void menu();
void saveEmployeesToFile();
void loadEmployeesFromFile();

// Function to check if a name is valid
int isValidName(char* name) {
    for (int i = 0; name[i] != '\0'; i++) {
        if (!isalpha(name[i]) && name[i] != ' ') {
            return 0;
        }
    }
    return 1;
}

// Function to check if an NRIC is valid
int isValidNRIC(char* nric) {
    for (int i = 0; nric[i] != '\0'; i++) {
        if (!isdigit(nric[i])) {
            return 0;
        }
    }
    return 1;
}

// Function to add a new employee
void addEmployee() {
    // Allocate memory for a new employee
    Employee* newEmployee = (Employee*)malloc(sizeof(Employee));
    if (!newEmployee) {
        // Display error message if memory allocation fails
        printf("\033[91mCannot add more employees. Memory allocation failed. [!]\033[0m\n");
        return;
    }

    printf("\033[1mEnter Employee ID: \033[0m");
    while (scanf("%d", &newEmployee->id) != 1) {
        // Handle invalid input for ID
        printf("\033[91mInvalid input [!] \033[0m\n");
        printf("\033[1mEnter a valid Employee ID: \033[0m");
        while (getchar() != '\n');
    }

    getchar();

    // Get input for Employee Name
    printf("\033[1mEnter Employee Name: \033[0m");
    fgets(newEmployee->name, sizeof(newEmployee->name), stdin);
    newEmployee->name[strcspn(newEmployee->name, "\n")] = 0;
    while (!isValidName(newEmployee->name)) {
        // Handle invalid input for Name
        printf("\033[91mInvalid input [!] \033[0m\n");
        printf("\033[1mEnter a valid Employee ID: \033[0m");
        fgets(newEmployee->name, sizeof(newEmployee->name), stdin);
        newEmployee->name[strcspn(newEmployee->name, "\n")] = 0;
    }

    // Get input for Employee NRIC
    printf("\033[1mEnter Employee NRIC: \033[0m");
    fgets(newEmployee->nric, sizeof(newEmployee->nric), stdin);
    newEmployee->nric[strcspn(newEmployee->nric, "\n")] = 0;
    while (!isValidNRIC(newEmployee->nric)) {
        // Handle invalid input for NRIC
        printf("\033[91mInvalid input [!] \033[0m\n");
        printf("\033[1mEnter a valid Employee NRIC:  \033[0m");
        fgets(newEmployee->nric, sizeof(newEmployee->nric), stdin);
        newEmployee->nric[strcspn(newEmployee->nric, "\n")] = 0;
    }

    // Get input for Employee Department
    printf("\033[1mEnter Employee Department: \033[0m");
    fgets(newEmployee->department, sizeof(newEmployee->department), stdin);
    newEmployee->department[strcspn(newEmployee->department, "\n")] = 0;

    // Get input for Employee Salary
    printf("\033[1mEnter Employee Salary: \033[0m");
    while (scanf("%f", &newEmployee->salary) != 1) {
        // Handle invalid input for Salary
        printf("\033[91mInvalid input [!] \033[0m\n");
        printf("\033[1mEnter a valid Salary: \033[0m");
        while (getchar() != '\n');
    }

    // Insert the new employee into the linked list
    newEmployee->next = head;
    head = newEmployee;

    printf("\033[92mEmployee with ID %d added successfully!\033[0m\n", newEmployee->id);
}

// Function to update employee details
void updateEmployee() {
    if (head == NULL) {
        printf("\033[92mNo employees to update. [!]\033[0m\n");
        return;
    }
    displayEmployees();

    int id;
    printf("\033[1mEnter Employee ID to update: \033[0m");
    while (scanf("%d", &id) != 1) {
        printf("\033[91mInvalid input [!] \033[0m\n");
        printf("\033[1mEnter a valid Employee ID: \033[0m");
        while (getchar() != '\n');
    }

    Employee* temp = head;
    while (temp != NULL) {
        if (temp->id == id) {
            getchar();

            printf("\033[94mChoose the field to update:\n");
            printf("1. Name\n");
            printf("2. NRIC\n");
            printf("3. Department\n");
            printf("4. Salary \033[0m\n");
            printf("\033[1mEnter your choice: \033[0m");
            int choice;
            while (scanf("%d", &choice) != 1 || choice < 1 || choice > 4) {
                printf("\033[91mInvalid input [!] \033[0m\n");
                printf("\033[1mEnter a valid choice (1-4): \033[0m");
                while (getchar() != '\n');
            }

            getchar();

            switch (choice) {
                case 1:
                    printf("\033[1mEnter new Employee Name: \033[0m");
                    fgets(temp->name, sizeof(temp->name), stdin);
                    temp->name[strcspn(temp->name, "\n")] = 0;
                    while (!isValidName(temp->name)) {
                        printf("\033[91mInvalid input [!] \033[0m\n");
                        printf("\033[1mEnter a valid Employee Name: \033[0m");
                        fgets(temp->name, sizeof(temp->name), stdin);
                        temp->name[strcspn(temp->name, "\n")] = 0;
                    }
                    break;
                case 2:
                    printf("\033[1mEnter new Employee NRIC (without dash): \033[0m");
                    fgets(temp->nric, sizeof(temp->nric), stdin);
                    temp->nric[strcspn(temp->nric, "\n")] = 0;
                    while (!isValidNRIC(temp->nric)) {
                        printf("\033[91mInvalid input [!] \033[0m\n");
                        printf("\033[1mEnter a valid Employee NRIC: \033[0m");
                        fgets(temp->nric, sizeof(temp->nric), stdin);
                        temp->nric[strcspn(temp->nric, "\n")] = 0;
                    }
                    break;
                case 3:
                    printf("\033[1mEnter new Employee Department: \033[0m");
                    fgets(temp->department, sizeof(temp->department), stdin);
                    temp->department[strcspn(temp->department, "\n")] = 0;
                    break;
                case 4:
                    printf("\033[1mEnter new Employee Salary: \033[0m");
                    while (scanf("%f", &temp->salary) != 1) {
                        printf("\033[91mInvalid input [!] \033[0m\n");
                        printf("\033[1mEnter a valid Salary: \033[0m");
                        while (getchar() != '\n');
                    }
                    break;
            }

            printf("\033[92mEmployee with ID %d updated successfully!\033[0m\n", id);
            return;
        }
        temp = temp->next;
    }

    printf("\033[91mEmployee with ID %d not found.\033[0m\n", id);
}

// Function to delete an employee
void deleteEmployee() {
    if (head == NULL) {
        printf("\033[92mNo employees to delete. [!]\033[0m\n");
        return;
    }

    int id;
    displayEmployees();
    printf("\033[1mEnter Employee ID to delete: \033[0m");
    while (scanf("%d", &id) != 1) {
        printf("\033[91mInvalid input [!] \033[0m\n");
        printf("\033[1mEnter a valid Employee ID: \033[0m");
        while (getchar() != '\n');
    }

    Employee* temp = head;
    Employee* prev = NULL;

    if (temp != NULL && temp->id == id) {
        head = temp->next;
        free(temp);
        printf("\033[92mEmployee with ID %d deleted successfully!\033[0m\n", id);
        return;
    }

    while (temp != NULL && temp->id != id) {
        prev = temp;
        temp = temp->next;
    }

    if (temp == NULL) {
        printf("\033[91mEmployee with ID %d not found.\033[0m\n", id);
        return;
    }

    prev->next = temp->next;
    free(temp);
    printf("\033[92mEmployee with ID %d deleted successfully!\033[0m\n", id);
}

// Function to sort employees by ID
void sortEmployees() {
    if (head == NULL) return;

    Employee* sorted = NULL;
    Employee* current = head;

    while (current != NULL) {
        Employee* next = current->next;
        if (sorted == NULL || sorted->id >= current->id) {
            current->next = sorted;
            sorted = current;
        } else {
            Employee* temp = sorted;
            while (temp->next != NULL && temp->next->id < current->id) {
                temp = temp->next;
            }
            current->next = temp->next;
            temp->next = current;
        }
        current = next;
    }
    head = sorted;
}

// Function to display all employees
void displayEmployees() {
    sortEmployees();
    Employee* temp = head;

    if (temp == NULL) {
        printf("\033[91mNo employees to display. [!]\033[0m\n");
        return;
    }

    printf("\033[94m-------------------------------------------------------------------------------------------\n");
    printf("| %-10s | %-20s | %-15s | %-20s | %-10s |\n", "ID", "Name", "NRIC", "Department", "Salary");
    printf("-------------------------------------------------------------------------------------------\n");

    while (temp != NULL) {
        printf("| %-10d | %-20s | %-15s | %-20s | %-10.2f |\n",
               temp->id, temp->name, temp->nric, temp->department, temp->salary);
        temp = temp->next;
    }

    printf("-------------------------------------------------------------------------------------------\n\033[0m");
}

// Function to find an employee by ID
Employee* findEmployeeById(int id) {
    Employee* temp = head;
    while (temp != NULL) {
        if (temp->id == id) { // Check if the current employee's ID matches the input ID
            return temp;
        }
        temp = temp->next; // Move to the next employee in the list
    }
    return NULL;
}

// Function to print employee details
void printEmployee(Employee* emp) {
    if (!emp) {// Check if the employee data is available
        printf("\033[91mEmployee data is not available. [!]\033[0m\n");
        return;
    }
     // Print employee details
    printf("\033[94m----------------------------------------------------\n");
    printf("| %-15s | %-30s |\n", "Employee", "Data");
    printf("----------------------------------------------------\n");
    printf("| %-15s | %-30d |\n", "ID", emp->id);
    printf("| %-15s | %-30s |\n", "Name", emp->name);
    printf("| %-15s | %-30s |\n", "NRIC", emp->nric);
    printf("| %-15s | %-30s |\n", "Department", emp->department);
    printf("| %-15s | %-30.2f |\n", "Salary", emp->salary);
    printf("----------------------------------------------------\n\033[0m");
}

// Function to search for an employee
void searchEmployee() {
    int id;
    printf("\033[1mEnter Employee ID to search: \033[0m");
    while (scanf("%d", &id) != 1) {
        printf("\033[91mInvalid input [!] \033[0m\n");
        printf("\033[1mEnter a valid Employee ID: \033[0m");
        while (getchar() != '\n');
    }

    Employee* emp = findEmployeeById(id);
    if (emp) {
        printEmployee(emp);
    } else {
        printf("\033[91mEmployee with ID %d not found.\033[0m\n", id);
    }
}

// Function to save employees to a file
void saveEmployeesToFile() {
    FILE* file = fopen("employees.dat", "wb");
    if (file == NULL) {
        printf("\033[91mError opening file for saving [!]\033[0m\n");
        return;
    }

    Employee* temp = head;
    while (temp != NULL) {
        if (fwrite(temp, sizeof(Employee), 1, file) != 1) {
            printf("\033[91mError writing to file [!]\033[0m\n");
            fclose(file);
            return;
        }
        temp = temp->next;
    }
    fclose(file);
}

// Function to load employees from a file
void loadEmployeesFromFile() {
    FILE* file = fopen("employees.dat", "rb");
    if (file == NULL) {
        printf("\033[91mNo saved data found [!]\033[0m\n");
        return;
    }

    Employee* temp = NULL;
    while (1) {
        Employee* newEmployee = (Employee*)malloc(sizeof(Employee));
        if (!newEmployee) {
            printf("\033[91mMemory allocation failed [!]\033[0m\n");
            fclose(file);
            return;
        }
        if (fread(newEmployee, sizeof(Employee), 1, file) != 1) {
            free(newEmployee);
            break;
        }
        newEmployee->next = temp;
        temp = newEmployee;
    }
    head = temp;
    fclose(file);
}

// Function to display the main menu
void menu() {
    int choice;
    while (1) {
        printf("\033[94m\n========================= Employee Management System ===========================\n");
        printf("|                                                                              |\n");
        printf("| Press [1] Add Employee                                                       |\n");
        printf("| Press [2] Update Employee                                                    |\n");
        printf("| Press [3] Delete Employee                                                    |\n");
        printf("| Press [4] Display Employees                                                  |\n");
        printf("| Press [5] Search Employee                                                    |\n");
        printf("| Press [6] Save and Exit System                                               |\n");
        printf("|                                                                              |\n");
        printf("================================================================================\033[0m\n");
        printf("\033[1mEnter your choice: \033[0m");
        while (scanf("%d", &choice) != 1) {
            printf("\033[91mInvalid input [!] \033[0m\n");
            printf("\033[1mPlease enter a number from 1 to 6: \033[0m");
            while (getchar() != '\n');
        }

        switch (choice) {
            case 1:
                addEmployee();
                break;
            case 2:
                updateEmployee();
                break;
            case 3:
                deleteEmployee();
                break;
            case 4:
                displayEmployees();
                break;
            case 5:
                searchEmployee();
                break;
            case 6:
                saveEmployeesToFile();
                printf("\033[92mData saved. Exiting the system.\033[0m\n");
                exit(0);
            default:
                printf("\033[91mInvalid input [!] \033[0m\n");
                printf("\033[1mPlease enter a number from 1 to 6: \033[0m");
        }
    }
}

int main() {
    loadEmployeesFromFile();
    menu();
    return 0;
}
