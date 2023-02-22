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
	MOV R0,#5
	MOV R1,#0
	MOV R1,R0
STOP
	B STOP	
	END