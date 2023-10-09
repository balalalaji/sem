/*
S --> aAcBe
A --> bA'|b
A' -->bA'
B --> d
*/
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
int curr = 0;
char str[100];
void S();
void A();
void APrime();
void B();
void invalid(){
printf("-----------------ERROR!----------------\n");
exit(0);
}
void valid(){
printf("----------------SUCCESS!---------------\n");
exit(0);
}

void S(){
	if(str[curr] == 'a'){
		curr++;
		A();
		if(str[curr] == 'c'){
			curr++;
			B();
			if(str[curr] == 'e'){
			curr++;
			return;
			}	
		}
	}
	else{
	invalid();
	}
}

void A(){
	if(str[curr] == 'b'){
		curr++;
		APrime();
		return;
		}
	else if(str[curr] == 'b'){
		return;
	else
		invalid();}
}
void APrime(){
		if(str[curr] == 'b'){
		curr++;
		APrime();
		return;
	}
	else{
		invalid();
	}
}
void B(){
		if(str[curr] == 'd'){
		curr++;
		return;
	}
	else{
		invalid();
	}
}
		
int main(){
	printf("Enter String: ");
	scanf("%s", str);
	S();
	A();
	APrime();
	B();
	if(str[curr] == '$')
	valid();
	else
	invalid();
	}