package dominio;

import org.json.JSONArray;
import org.json.JSONObject;

import presentacion.GeneradorPNG;

/* Nombre: LectorJSON
 * Tipo: Clase
 * Funci�n: Crear un array que represente al laberinto a partir de un objeto JSON
 */
public class LectorJSON {
	GeneradorPNG generadorPNG;
	
	/* Nombre: LectorJSON
	 * Tipo: M�todo
	 * Funci�n:
	 */
	public LectorJSON() {
		// Vac�o
	}
	
	/* Nombre: leerInterno
	 * Tipo: M�todo
	 * Funci�n: Generaci�n del array que representa el laberinto a partir de un objeto JSON
	 */
	public void leer(JSONObject laberinto) {
		generadorPNG = new GeneradorPNG();
		Celda[][] lab;
		Celda c;
		
		lab = new Celda[laberinto.getInt("rows")][laberinto.getInt("cols")];
		
		JSONObject celdas = laberinto.getJSONObject("cells");
		
		for(int i=0; i<lab.length; i++) { // Bucle for que instancia objetos de la clase Celda
			for(int j=0; j<lab[0].length; j++) {
				c = new Celda(j,i);
				
				JSONObject celda = celdas.getJSONObject("("+i+","+j+")"); // JSONObject que representa una celda gracias a su fila y columna
				JSONArray muros = celda.getJSONArray("neighbors"); // JSONArray que representa el valor de cada muro de una celda
				
				int valor = celda.getInt("value");
				
				c.setValor(valor);
				
				for(int m=0; m<muros.length(); m++) {
					c.setMuro(m, muros.getBoolean(m));
				}
				
				lab[i][j] = c; // A�adimos la celda en su posici�n correspondiente
			}
			
		}
		
		boolean correcto=comprobarValidez(lab);
		
		if(correcto) {
			generadorPNG.generar(lab); // Enviamos el array a la clase encargadada de crear el archivo PNG
		}
	}
	
	/* Nombre: comprobarValidez
	 * Tipo: M�todo
	 * Funci�n: Comprobar que los booleanos que representan los muros con celdas vecinas son correctos
	 */
	public boolean comprobarValidez(Celda[][] lab) {
		boolean correcto=true;
		
		for(int i=0; i<lab.length; i++) { // Bucle for que instancia objetos de la clase Celda
			for(int j=0; j<lab[0].length; j++) {
				if(lab[i][j].getMuro(0)==true && lab[i-1][j].getMuro(2)==false) return false;
				if(lab[i][j].getMuro(1)==true && lab[i][j+1].getMuro(3)==false) return false;
				if(lab[i][j].getMuro(2)==true && lab[i+1][j].getMuro(0)==false) return false;
				if(lab[i][j].getMuro(3)==true && lab[i][j-1].getMuro(1)==false) return false;
			}
			
		}
		
		return correcto;
	}

}
