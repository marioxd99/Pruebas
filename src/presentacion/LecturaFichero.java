package presentacion;

import java.io.BufferedReader;
import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.IOException;
import java.util.Scanner;


import org.json.JSONObject;

import dominio.LectorJSON;

/* Nombre: LecturaFichero
 * Tipo: Clase
 * Funci�n: Leer fichero externo
 */
public class LecturaFichero {
	private static Scanner teclado = new Scanner(System.in);
	LectorJSON lectorJSON;
	
	/* Nombre: LecturaFichero
	 * Tipo: M�todo
	 * Funci�n: Constructor de clase LecturaFichero
	 */
	public LecturaFichero() {
		// Vac�o
	}
	
	public void obtener() throws IOException {
		Scanner s = null;
		int ok=0;
		lectorJSON= new LectorJSON();
		
		do {
			System.out.println("\nIntroduzca el nombre del fichero (sin extensi�n):");
			String nombre = teclado.next();
			try {
				s = new Scanner(new File(nombre+".json"));
				ok=1;
			} catch(FileNotFoundException e) {
				System.err.println("No se ha encontrado el archivo especificado");
			}
		} while(ok!=1);
		
		String cadena="";
		
        while(s.hasNextLine()) {
            cadena=cadena+s.next();
        }
        
        s.close();
		
        System.out.print("Cadena"+cadena);
		System.exit(0);
		
		JSONObject objetoCompleto = new JSONObject(cadena);
		
        lectorJSON.leer(objetoCompleto); // Enviamos el objeto JSON a la clase encargada de crear el array que representa el laberinto
	}
	
	
	

}
