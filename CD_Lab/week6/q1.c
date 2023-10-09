/*
S --> a | > | ( T )
T --> T'|S
T'--> ,S
*/
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
int curr = 0;
char str[100];
void S();
void T();
void TPrime();
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
		return;
	}
	else if(str[curr] == '>'){
		curr++;
		return;
	}
	else if(str[curr] == '('){
		int temp=curr;
		curr++;
		T();
		if(str[curr] == ')'){
			curr++;
	}
}
		int temp=curr;
}

void T(){
	TPrime();
	S();
}
void TPrime(){
		if(str[curr] == ','){
		int temp=curr;
		curr++;
		S();
		return;
}
}
int main(){
	printf("Enter String: ");
	scanf("%s", str);
	S();
	T();
	if(str[curr] == '$')
	valid();
	else
	invalid();
	}