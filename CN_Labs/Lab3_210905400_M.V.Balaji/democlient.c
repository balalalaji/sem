#include<stdio.h>
#include<stdlib.h>
#include<fcntl.h>
#include<sys/socket.h>
#include<sys/types.h>
#include<netinet/in.h>
#include<arpa/inet.h>
#include<unistd.h>
int main(){
	int sd;
	struct sockaddr_in address;
	sd=socket(AF_INET,SOCK_DGRAM,0);
	address.sin_family=AF_INET;
	address.sin_addr.s_addr=inet_addr("127.0.0.1");
	address.sin_port=htons(9704);
	char buf[25],buf1[25];
	printf("Enter buffer:");
	scanf("%s",buf);
	int len=sizeof(address);
	int m=sendto(sd,buf,sizeof(buf),0,(struct sockaddr *)&address, len);
	int n=recvfrom(sd,buf,sizeof(buf),0,(struct sockaddr *)&address,&len);
	printf("Server output is:%s",buf);
	return 0;
}