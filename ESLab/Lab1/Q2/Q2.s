	AREA RESET,DATA,READONLY
	EXPORT __Vectors
		
__Vectors
	DCD 0x10001000
	DCD Reset_Handler
	ALIGN
	AREA mycode,CODE,READONLY
	ENTRY
	EXPORT Reset_Handler
Reset_Handler
	LDR R0,=SRC
	MOV R0,#5
	LDR R1,=DST
	MOV R1,R0
STOP
	B STOP	
SRC DCD 0
DST	DCD 0
	END