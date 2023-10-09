#include<stdio.h>
#include<stdlib.h>
int main(){
	FILE *fa,*fb;
	char ca,cb;
	cb=' ';
	fa = fopen("file1.c", "r");
	fb = fopen("file2.c", "w");
	if (fa == NULL){
		printf("Cannot open file \n");
		exit(0);
	 }
	 ca=fgetc(fa);
	 while(ca !=EOF){
	 // ca=fgetc(fa);
	 while(ca==' '||ca=='\t'){
			ca=fgetc(fa);
			if(ca==' '||ca=='\t'){
				fputc(cb,fb);
				}
		}
		fputc(ca, fb);
		ca=fgetc(fa);
	 }
	fclose(fa);
	fclose(fb);
	printf("Changes Made\n");
	return 0;
	}
