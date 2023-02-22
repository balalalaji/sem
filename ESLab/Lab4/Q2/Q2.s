	AREA RESET, DATA, READONLY
	EXPORT __Vectors
		
__Vectors
	
	DCD 0X10001000
	DCD Reset_Handler
	ALIGN
	AREA mycode, CODE, READONLY
	ENTRY
	EXPORT Reset_Handler
	
Reset_Handler
		LDR R6,=RESULT
		MOV R2,#0
		LDR R0,=VAL1
		LDR R1,[R0]
UP		CMP R1,#0xA
		BCC STORE
		SUB R1,#0xA
		ADD R1,#01
		B UP
STORE	STRB R1,[R6],#1
		MOV R1,R2
		CMP R1,#0xA
		BCS UP
		STRB R1,[R6],#1
		MOV R3,R6
		LDR R2,=PACKED
		LDR R6,=RESULT
		SUB R4,R3,R6
UP1		LDRB R0,[R6],#1
		LDRB R1,[R6],#1
		LSL R1,#4
		ORR R1,R0
		STRB R1,[R2],#1
		SUB R4,#2
		CMP R4,#1
		BGE UP1
STOP
	B STOP
	
N1 DCD 0x11110101
	AREA mydata, DATA, READWRITE
DST DCD 0
	END