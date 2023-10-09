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
void E();
void Eprime();
void T();
void Tprime();
void F();
void invalid(){
printf("-----------------ERROR!----------------\n");
exit(0);
}
void valid(){
printf("----------------SUCCESS!---------------\n");
exit(0);
}
void E(){
T();
Eprime();
}
void Eprime(){
	if(str[curr] == '+'){
		curr++;
		T();
		Eprime();
	}
}

void T(){
	F();
	Tprime();
}

void Tprime(){
	if(str[curr] == '*'){
		curr++;
		F();
		Tprime();
		}
	}
void F(){
	if(str[curr] == '('){
		curr++;
		E();
		if(str[curr] == ')'){
			curr++;
			return;
	}
	else
	invalid();
	}
	else if(str[curr] == 'i')	{
		curr++;
		return;
	}
	else
	invalid();
}
int main(){
printf("Enter String: ");
scanf("%s", str);
E();
if(str[curr] == '$')
valid();
else
invalid();
}
/*
Write a recursive descent parser for the following simple grammars.

1.
S --> a | > | ( T )
T --> T,S|S

2.
S --> UVW
U --> (S) | aSb | d
V --> aV |Epsilon
W --> W |Epsilon

3. 
S --> aAcBe
A --> Ab|b
B --> d

*/