/*
2.
S --> UVW
U --> (S) | aSb | d
V --> aV |Epsilon
W --> W |Epsilon
*/
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
int curr = 0;
char str[100];
void S();
void U();
void V();
void W();
void invalid(){
printf("-----------------ERROR!----------------\n");
exit(0);
}
void valid(){
printf("----------------SUCCESS!---------------\n");
exit(0);
}
void S(){
	U();
	V();
	W();
}
void U(){
	//int temp=curr;
	if(str[curr] == '('){
		int temp=curr;
		curr++;
		S();
		if(str[curr] == ')'){
			curr++;
	}
	else
	invalid();
	}
	else if(str[curr] == 'a'){
		curr++;
		S();
		curr++;
		if(str[curr] == 'b'){
			curr++;
		}
}
	else if(str[curr]=='d'){
		curr++;
	}
}
void V(){
	//nt temp=curr;
	while(str[curr] == 'a'){
		curr++;
		return;
	}
}
void W(){
	//int temp=curr;
	W();
}
int main(){
printf("Enter String: ");
scanf("%s", str);
S();
if(str[curr] == '$')
valid();
else
invalid();
}
