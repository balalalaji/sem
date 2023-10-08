#include<stdio.h>
#include<stdlib.h>
#include<string.h>
#include<sys/socket.h>
#include<sys/types.h>
#include <netinet/in.h>
#include<error.h>
#define PORTNO 10200
int main(){
	int sockfd,newsockfd,portno,client_len,i,value,n=1;
	int buf[256];
	struct sockaddr_in seraddr,client_addr;
	sockfd = socket(AF_INET,SOCK_STREAM,0);
	seraddr.sin_family=AF_INET;
	seraddr.sin_addr.s_addr=inet_addr("127.0.0.1");
	seraddr.sin_port=htons(PORTNO);
	bind(sockfd,(struct sockaddr *)&seraddr,sizeof(seraddr));
	listen(sockfd,5);
	while(1){
		client_len=sizeof(client_len);
		newsockfd=accept(sockfd,(struct sockaddr *)&client_addr,&client_len);
		if(fork()==0){
			n=read(newsockfd,buf,sizeof(buf));
			printf(" \nMessage from Client %d \n",buf);
			n=read(newsockfd,buf,sizeof(buf));
			close(newsockfd);
			exit(0);
		}
		else
			close(newsockfd);
	}
}