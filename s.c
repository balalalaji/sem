#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <sys/socket.h>
#include <netinet/in.h>
#include <unistd.h>

#define PORT 8888
#define MAX_CLIENTS 2
#define MAX_QUESTIONS 5
#define MAX_ANSWER_LEN 50

char *questions[MAX_QUESTIONS] = {
    "What is the capital of France?",
    "Which planet is known as the Red Planet?",
    "What is the largest mammal?",
    "How many continents are there?",
    "What is the boiling point of water in Celsius?"
};

char *answers[MAX_QUESTIONS] = {
    "paris",
    "mars",
    "blue whale",
    "7",
    "100"
};

void error(const char *msg) {
    perror(msg);
    exit(1);
}

int main() {
    int server_fd, new_socket, valread;
    struct sockaddr_in address;
    int opt = 1;
    int addrlen = sizeof(address);
    char buffer[MAX_ANSWER_LEN] = {0};

    if ((server_fd = socket(AF_INET, SOCK_STREAM, 0)) == 0) {
        error("Socket creation failed");
    }

    if (setsockopt(server_fd, SOL_SOCKET, SO_REUSEADDR | SO_REUSEPORT, &opt, sizeof(opt))) {
        error("Setsockopt failed");
    }

    address.sin_family = AF_INET;
    address.sin_addr.s_addr = INADDR_ANY;
    address.sin_port = htons(PORT);

    if (bind(server_fd, (struct sockaddr *)&address, sizeof(address)) < 0) {
        error("Bind failed");
    }

    if (listen(server_fd, MAX_CLIENTS) < 0) {
        error("Listen failed");
    }

    int client_scores[MAX_CLIENTS] = {0};

    for (int i = 0; i < MAX_CLIENTS; ++i) {
        new_socket = accept(server_fd, (struct sockaddr *)&address, (socklen_t *)&addrlen);
        if (new_socket < 0) {
            error("Accept failed");
        }

        printf("Client %d connected\n", i + 1);

        int question_number = 0;

        while (question_number < MAX_QUESTIONS) {
            send(new_socket, questions[question_number], strlen(questions[question_number]), 0);
            valread = read(new_socket, buffer, MAX_ANSWER_LEN);
            buffer[valread] = '\0';

            if (strcasecmp(buffer, answers[question_number]) == 0) {
                client_scores[i]++;
                send(new_socket, "Correct!\n", 9, 0);
            } else {
                send(new_socket, "Incorrect!\n", 11, 0);
            }

            question_number++;
        }

        printf("Client %d's Score: %d\n", i + 1, client_scores[i]);

        close(new_socket);
    }

    new_socket = accept(server_fd, (struct sockaddr *)&address, (socklen_t *)&addrlen);
    if (new_socket < 0) {
        error("Accept failed");
    }

    if (client_scores[0] > client_scores[1]) {
        send(new_socket, "Player 1 is the winner!\n", 24, 0);
        send(new_socket, "Player 2 is the loser!\n", 23, 0);
    } else if (client_scores[1] > client_scores[0]) {
        send(new_socket, "Player 2 is the winner!\n", 24, 0);
        send(new_socket, "Player 1 is the loser!\n", 23, 0);
    } else {
        send(new_socket, "It's a draw!\n", 13, 0);
        send(new_socket, "It's a draw!\n", 13, 0);
    }

    close(new_socket);
    close(server_fd);
    return 0;
}
