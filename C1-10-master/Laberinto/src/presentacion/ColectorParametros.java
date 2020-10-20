package presentacion;

import java.util.InputMismatchException;
import java.util.Scanner;

/* Nombre: ColectorParametros
 * Tipo: Clase
 * Funcion: Recoger altura y anchura de array contenedor de celdas por teclado
 */
public class ColectorParametros {
	private static Scanner teclado = new Scanner(System.in);
	
	/* Nombre: ColectorParametros
	 * Tipo: Metodo
	 * Funcion: Constructor de clase ColectorParametros
	 */
	public ColectorParametros() {
		// Vacio
	}
	
	/* Nombre: pedirParametros
	 * Tipo: Metodo
	 * Funcion: Interaccion con usuario para introducci�n de parametros del laberinto por teclado
	 */
	public int[] pedirParametros() {
		int[] parametros = new int[2];
		int ok1=0;
		int ok2=0;
		
		do {
			System.out.println("\nIntroduzca n�mero de filas: ");
			try {
				parametros[0] = teclado.nextInt();
				ok1=1;
			}catch(InputMismatchException e) {
				System.err.println("Introduzca un valor num�rico");
				teclado.next();
			}
			if(parametros[0]<=1) System.err.println("Debe introducir un valor num�rico positivo y mayor a 1");
		} while(parametros[0]<=1 || ok1!=1);

		do {
			System.out.println("Introduzca n�mero de columnas: ");
			try {
				parametros[1] = teclado.nextInt();
				ok2=1;
			}catch(InputMismatchException e) {
				System.err.println("\nIntroduzca un valor num�rico");
				teclado.next();
			}
			if(parametros[1]<=1) System.err.println("Debe introducir un valor num�rico positivo y mayor a 1");
		} while(parametros[1]<=1 || ok2!=1);
		
		return parametros;
	}


}
