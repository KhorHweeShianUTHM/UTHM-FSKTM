#include<stdio.h>

void calculateFirstConstraint(int r, int d);
void calculateSecondConstraint(int r, int d);
void subtractionFirstSecondConstraint(int r, int d);
void calculateObjective(int r, int d);

int main(){
	int r, d;
	printf("Step 1. Define the variables");
	printf("\nProduct\t\t\t\tRegular combo (RM4)\tDeluxe combo (RM5)\tTotal");
	printf("\nSweet potato strips\t\t\t15\t\t\t20\t\t360");
	printf("\nPurple sweet potato strips\t\t5\t\t\t5\t\t100");

	printf("\n\nStep 2. Define the objective of the variables");
	printf("\nProfit (Regular, Deluxe) = 4 Regular + 5 Deluxe");
	
	printf("\n\nStep 3. Define the constraints of the variables");
	printf("\nFirst constraint => 15 Regular + 20 Deluxe ≤ 360 ");
	printf("\nSecond constraint => 5 Regular + 5 Deluxe ≤ 100 ");
	
calculateFirstConstraint(r,d); 
calculateSecondConstraint(r,d);
subtractionFirstSecondConstraint(r,d);
calculateObjective(r,d);
}

void calculateFirstConstraint(int r, int d){
	r = 360 / 15;
	d = 360 / 20;
	
	printf("\n\nStep 4. Calculate first constraints");
	printf("\nFirst constraint => 15 Regular + 20 Deluxe ≤ 360 ");
	printf("\nIf Deluxe = 0\t\t\t|If Regular = 0");
	printf("\n15 Regular + 20 (0) ≤ 360\t|15 (0) + 20 Deluxe ≤ 360");
	printf("\n15 Regular ≤ 360\t\t|20 Deluxe ≤ 360");
	printf("\nRegular ≤ %d\t\t\t|Deluxe ≤ %d", r, d);
	printf("\nFirst graph line (Regular %d, Deluxe %d)",r,d);
}

void calculateSecondConstraint(int r, int d){
	r = 100 / 5;
	d = 100 / 5;
	
	printf("\n\nStep 5. Calculate second constraints");
	printf("\nSecond constraint => 5 Regular + 5 Deluxe ≤ 100");
	printf("\nIf Deluxe = 0\t\t\t|If Regular = 0");
	printf("\n5 Regular + 5 (0) ≤ 100\t\t|5 (0) + 5 Deluxe ≤ 100");
	printf("\n5 Regular ≤ 100\t\t\t|5 Deluxe ≤ 100");
	printf("\nRegular ≤ %d\t\t\t|Deluxe ≤ %d", r,d);
	printf("\nSecond graph line (Regular %d, Deluxe %d)",r,d);
}

void subtractionFirstSecondConstraint(int r, int d){
	d = 60 / 5;
	r = (100-5*d)/5;
	
	printf("\n\nStep 5. Substraction first and second constraints");
	printf("\nSecond constraint => 5 Regular + 5 Deluxe ≤ 100");
	printf("\nFirst constraint => 15 Regular + 20 Deluxe ≤ 360 ");
	printf("\nThird constraint => 15 Regular + 15 Deluxe ≤ 300 (The second constraint is multiplied by 3 and becomes the third constraint)");
	printf("\nSubstraction of First and Second contraint => 5 Deluxe ≤ 60");
	printf("\n5 Deluxe ≤ 60");
	printf("\nDeluxe ≤ %d", d);
	printf("\nIf Deluxe = %d",d);
	printf("\n5 Regular + 5(%d) ≤ 100",5*d);
	printf("\n5 Regular ≤ 100 - %d",5*d);
	printf("\n5 Regular ≤ %d",100-5*d);
	printf("\nRegular ≤ %d",r);
	printf("\nPoint where two lines intersect is (Regular %d, Deluxe %d)",r,d);
}

void calculateObjective(int r, int d){
	d = 12;
	r = 8;
	
	printf("\n\nStep 6. Calculate the objective variables");
	printf("\nf(r,d) = 4r + 5d");
	printf("\n= 4(%d) + 5(%d)",r,d);
	printf("\n= %d",(4*r)+(5*d));
	printf("\n\nConclusion: Profit will be maximized if 8 boxes or regular mix and 12 boxes of deluxe mix are made and sold. Finally, the company will earn RM92.");
}