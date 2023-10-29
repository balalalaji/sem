#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <sys/socket.h>
#include <netinet/in.h>
#include <arpa/inet.h>
#include <unistd.h>

#define MAX_ANSWER_LEN 50

int main() {
    int c_sock;
    char buf[MAX_ANSWER_LEN];
    char msg[MAX_ANSWER_LEN];

    c_sock = socket(AF_INET, SOCK_STREAM, 0);
    struct sockaddr_in client;

    memset(&client, 0, sizeof(client));
    client.sin_family = AF_INET;
    client.sin_port = htons(8888); // Connect to the server on port 8888
    client.sin_addr.s_addr = inet_addr("127.0.0.1");

    if (connect(c_sock, (struct sockaddr *)&client, sizeof(client)) == -1) {
        printf("Error: Server seems to be down or game member limit reached. Exiting...\n");
        exit(0);
    }

    printf("Establishing connection to the game server...\n\n");

    while (1) {
        int bytes_received = recv(c_sock, msg, MAX_ANSWER_LEN, 0);
        if (bytes_received <= 0) {
            break;
        }

        msg[bytes_received] = '\0';
        printf("Question: %s\n", msg);

        fgets(buf, MAX_ANSWER_LEN, stdin);
        buf[strcspn(buf, "\n")] = 0; // Remove newline character from the input

        send(c_sock, buf, strlen(buf), 0);
    }

    close(c_sock);
    return 0;
}
