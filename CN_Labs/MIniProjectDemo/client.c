//gcc client.c -o c
//./c localhost 1234
#include <stdio.h>
#include <sys/types.h>
#include <sys/socket.h>
#include <netinet/in.h>
#include <arpa/inet.h>
#include <unistd.h>
#include <stdlib.h>
#include <stdbool.h>

char board[9];
int turn = 1;
bool play = true;
bool win = false;

void clearBoard() {
    for (int i = 0; i < 9; i++) {
        board[i] = '_';
    }
}

void printBoard() {
    printf("%c %c %c\n", board[0], board[1], board[2]);
    printf("%c %c %c\n", board[3], board[4], board[5]);
    printf("%c %c %c\n", board[6], board[7], board[8]);
}

void placePiece(int move) {
    char xo = (turn % 2 == 0) ? 'o' : 'x';
    board[move - 1] = xo;
    printBoard();
}

bool checkWin(char player) {
    // Check win conditions for the specified player (either 'x' or 'o').
    if ((board[0] == player && board[1] == player && board[2] == player) ||
        (board[3] == player && board[4] == player && board[5] == player) ||
        (board[6] == player && board[7] == player && board[8] == player) ||
        (board[0] == player && board[3] == player && board[6] == player) ||
        (board[1] == player && board[4] == player && board[7] == player) ||
        (board[2] == player && board[5] == player && board[8] == player) ||
        (board[0] == player && board[4] == player && board[8] == player) ||
        (board[2] == player && board[4] == player && board[6] == player)) {
        win = true;
        return true;
    }
    return false;
}

int main(int argc, char *argv[]) {
    int sockfd, portno, n;
    struct sockaddr_in serv_addr;

    char buffer[256];
    if (argc < 3) {
        fprintf(stderr, "Usage: %s server_ip_address port\n", argv[0]);
        exit(0);
    }

    portno = atoi(argv[2]);
    sockfd = socket(AF_INET, SOCK_STREAM, 0);

    serv_addr.sin_family = AF_INET;
    serv_addr.sin_port = htons(portno);

    connect(sockfd, (struct sockaddr *)&serv_addr, sizeof(serv_addr));

    printf("Connection Successful\n");
    clearBoard();
    printBoard();

    while (play) {
        int move;
        printf("Make move (1 - 9): ");
        scanf("%d", &move);

        while (board[move - 1] != '_') {
            if (move < 1 || move > 9) {
                printf("Move Invalid\n");
            } else {
                printf("That space has been taken\n");
            }
            printf("Make move (1 - 9): ");
            scanf("%d", &move);
        }

        n = write(sockfd, &move, sizeof(move));
        placePiece(move);

        if (checkWin('x')) {
            printf("Player 'x' wins!\n");
            play = false;
        } else if (checkWin('o')) {
            printf("Player 'o' wins!\n");
            play = false;
        }

        if (play)
            turn++;

        if (turn == 10) {
            printf("Cats Game!\n");
            printf("Disconnected\n");
            play = false;
        }

        if (play) {
            int x;
            read(sockfd, &x, sizeof(x));
            printf("Move from server received: %d\n", x);
            placePiece(x);

            if (checkWin('x')) {
                printf("Player 'x' wins!\n");
                play = false;
            } else if (checkWin('o')) {
                printf("Player 'o' wins!\n");
                play = false;
            }

            if (play)
                turn++;
        }
    }

    return 0;
}
