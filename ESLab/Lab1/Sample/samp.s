	AREA RESET,DATA,READONLY
	EXPORT __Vectors
__Vectors
	DCD 0X10001000
	DCD Reset_Handler
		ALIGN
		AREA mycode,CODE,READONLY
		ENTRY
		EXPORT Reset_Handler
Reset_Handler
		MOV R0,#15
		MOV R1,#5
		ADD R2,R1,R0
STOP	B STOP
		END