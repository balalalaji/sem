#include<stdio.h>
#include<stdlib.h>
int main(){
	FILE *fa,*fb;
	char ca;
	fa = fopen("file1.c", "r");
	if (fa == NULL){
	printf("Cannot open file \n");
	exit(0); 
	}
	fb = fopen("file2.c", "w");
	ca=fgetc(fa);
	while(ca!=EOF){
		if(ca=='#'){
			while(ca!='\n'){
				ca=fget (fa);
			}
	fputc(ca,fb);
	ca = fgetc(fa);
	}
}
fclose(fa);
fclose(fb);
printf("Changes Made");
return 0;
}
