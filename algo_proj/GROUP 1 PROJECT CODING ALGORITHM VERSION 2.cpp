#include <stdio.h>

// Constants for billing calculation
const float FLAT_MIN = 600;
const float FLAT_RATE = 39.99;
const float ADDITIONAL_COST_PER_MIN = 0.2;
const float TAX = 0.055;

// Structure to store user information
struct Customer {
    char name[50];// Assuming the name has a maximum length of 49 characters
    float weekday_min;
    float night_min;
    float weekend_min;
};

// Function prototypes
void welcomeMessage();
void getUserInput(struct Customer *customer);
void displayUserInput(const struct Customer *customer);
void calculateAndDisplayBill(const struct Customer *customer);

int main() {
    char continue_program;

	// Loop to allow multiple users to calculate their bills
    do {
        struct Customer customer; // Declare a structure variable for customer information

        welcomeMessage();
        getUserInput(&customer);
        displayUserInput(&customer);
        calculateAndDisplayBill(&customer);

        // Prompt to calculate another bill
        printf("\nDo you want to calculate another bill? (Y/N): ");
        scanf(" %c", &continue_program);
        printf("\n");
    } while (continue_program == 'y' || continue_program == 'Y'); // Loop until the user enters 'N' or 'n'

    return 0;
}

// Function to display a welcome message and Offer details
void welcomeMessage() {
    printf("-------------------------------------------------\n");
    printf("|\tWelcome to Kebabo Internet Services\t|\n");
    printf("-------------------------------------------------\n");
    printf("\nWe offer customers 600 weekday minutes for a flat rate of RM39.99");
    printf("\nNight and weekend minutes are free, but additional weekday minutes cost RM0.20 each.");
    printf("\nThere are Service taxes (SST) of 5.5%% on all charges.\n");
}


// Function to get user input
void getUserInput(struct Customer *customer) {
    printf("\nEnter your nickname\t\t\t\t\t\t: ");
    scanf("%49s", customer->name);
    
    printf("Enter the number of weekday minutes used\t\t\t: ");
    scanf("%f", &(customer->weekday_min));
    
    printf("Enter the number of night minutes used (8.00 P.M. to 7.00 A.M.) : ");
    scanf("%f", &(customer->night_min));
    
    printf("Enter the number of weekend minutes used (Saturday to Sunday)\t: ");
    scanf("%f", &(customer->weekend_min));
}

// Function to display user input
void displayUserInput(const struct Customer *customer) {
    printf("\n---------------------------------------------------------");
    printf("\n\tHello, %s. This is your Monthly Internet Service Bill.", customer->name);
    printf("\n\nWeekday minutes used\t\t\t: %.2f Minutes", customer->weekday_min);
    printf("\nNight minutes used\t\t\t: %.2f Minutes", customer->night_min);
    printf("\nWeekend minutes used\t\t\t: %.2f Minutes", customer->weekend_min);
}

// Function to calculate and display the bill
void calculateAndDisplayBill(const struct Customer *customer) {
    float pre_tax_bill, sst_cost, total_bill, average_min_cost;

    if (customer->weekday_min > FLAT_MIN) {
        pre_tax_bill = ((customer->weekday_min - FLAT_MIN) * ADDITIONAL_COST_PER_MIN) + FLAT_RATE;
    } else {
        pre_tax_bill = FLAT_RATE;
    }

    sst_cost = pre_tax_bill * TAX;
    total_bill = pre_tax_bill + sst_cost;

    // Calculate average cost per minute before taxes
    average_min_cost = ((customer->weekday_min + customer->night_min + customer->weekend_min) - FLAT_MIN) / (FLAT_RATE * 100);

    // Display billing details with appropriate labels
    printf("\nAverage Cost per Minute Before Taxes\t: RM %.2f", average_min_cost);
    printf("\nService Tax Cost (SST)\t\t\t: RM %.2f", sst_cost);
    printf("\nPre-Tax Bill\t\t\t\t: RM %.2f", pre_tax_bill);
    printf("\nTotal Bill\t\t\t\t: RM %.2f", total_bill);
    printf("\n---------------------------------------------------------");
}