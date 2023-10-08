#include <stdio.h>
#include <sys/types.h>
#include <sys/socket.h>
#include <netinet/in.h>
#include <unistd.h>
#include <stdlib.h>
#include <time.h>

int movesMade[9] = {0}; 

void checkclient(int);

void error(char *msg) {
    perror(msg);
    exit(1);
}

int main(int argc, char *argv[]) {
    int sockfd, newsockfd, portno, clilen, pid;
    struct sockaddr_in serv_addr, cli_addr;

    if (argc < 2) {
        fprintf(stderr, "ERROR, no port provided\n");
        exit(1);
    }

    sockfd = socket(AF_INET, SOCK_STREAM, 0);
    if (sockfd < 0)
        error("ERROR opening socket");

    printf("Socket Created.\n");

    portno = atoi(argv[1]);
    serv_addr.sin_family = AF_INET;
    serv_addr.sin_addr.s_addr = INADDR_ANY;
    serv_addr.sin_port = htons(portno);
    if (bind(sockfd, (struct sockaddr *) &serv_addr, sizeof(serv_addr)) < 0)
        error("ERROR on binding");

    printf("Binding Complete.\n");

    listen(sockfd, 5);
    printf("Waiting for client connection.\n");
    clilen = sizeof(cli_addr);
    
    while (1) {
        newsockfd = accept(sockfd, (struct sockaddr *) &cli_addr, &clilen);
        if (newsockfd < 0)
            error("ERROR on accept");

        pid = fork();
        if (pid < 0)
            error("ERROR on fork");

        if (pid == 0) {
            printf("Connected to Client.\n");
            close(sockfd);
            srand(time(NULL));

            while (pid == 0)
                checkclient(newsockfd);

            exit(0);
        } else {
            close(newsockfd);
        }
    }
    return 0;
}

void checkclient(int sock) {
    int n, x;
    n = read(sock, &x, sizeof(x));

    if (movesMade[x - 1] == 1) {
        printf("Client Disconnected.\n");
        exit(0);
    }

    if (n < 0)
        exit(0);

    printf("Client sent move: %d\n", x);

    movesMade[x - 1] = 1;

    int random;
    do {
        random = rand() % 9 + 1;
    } while (movesMade[random - 1] == 1);

    printf("Sent move to client: %d\n", random);

    movesMade[random - 1] = 1;

    write(sock, &random, sizeof(random));

    if (n < 0)
        error("ERROR writing to socket");
}
