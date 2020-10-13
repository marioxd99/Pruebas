package presentacion;

import java.awt.BorderLayout;
import java.awt.Color;
import java.awt.Graphics;

import javax.swing.JFrame;
import javax.swing.JPanel;

import dominio.Celda;

/* Nombre: GeneradorFrame
 * Tipo: Clase
 * Funci�n: Generaci�n y modificaci�n de JFrame contenedor del laberinto
 */
public class GeneradorFrame {
	JFrame frameLaberinto; // Variable que representa el JFrame contenedor del laberinto
	Celda[][] aux; // La variable aux almacenar� el array que representa el laberinto y ser� usada como ayuda para pintar las celdas
	AuxiliarPanel panel;
	
	/* Nombre: GeneradorFrame
	 * Tipo: M�todo
	 * Funci�n: Constructor de clase GeneradorFrame
	 */
	public GeneradorFrame() {
		// Vac�o
	}
	
	/* Nombre: generar
	 * Tipo: M�todo
	 * Funci�n Crear JFrame que alojar� el laberinto
	 */
	public void generar(Celda[][] laberinto) {
		frameLaberinto = new JFrame("Laberinto " + laberinto.length + "x" + laberinto[0].length);
		aux = laberinto; 

		frameLaberinto.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);

		panel = new AuxiliarPanel(); 
		frameLaberinto.getContentPane().add(BorderLayout.CENTER, panel);

		frameLaberinto.setSize(laberinto[0].length * Celda.TAMAÑO + 10, laberinto.length * Celda.TAMAÑO + 30);
		frameLaberinto.setBackground(Color.BLACK);
		frameLaberinto.setLocationRelativeTo(null);
		frameLaberinto.setResizable(false);
		frameLaberinto.setVisible(true);
		
	}
	
	/* Nombre: repintar
	 * Tipo: M�todo
	 * Funci�n: Actualizar el JFrame que representa el laberinto
	 */
	public void repintar() {
		frameLaberinto.repaint();
	}
	
	/* Nombre: AuxiliarPanel
	 * Tipo: Clase
	 * Funci�n: Clase implementadora de Graphics, la cual pintar� todas las celdas dentro de panel con su correspondiente color
	 */
	class AuxiliarPanel extends JPanel {
		private static final long serialVersionUID = 1L;
		
		@Override
		public void paintComponent(Graphics g) {

			for (int i = 0; i < aux.length; i++) { // Este bucle anidado dibujar� cada una de las celdas que componen el laberinto
				for (int j = 0; j < aux[0].length; j++) {
					int x = j*Celda.TAMAÑO; // La variable x representar� la coordenada en eje de abcisas
					int y = i*Celda.TAMAÑO; // La variable y representar� la coordenada en eje de ordenadas
					
					g.setColor(aux[i][j].getColor());
					g.fillRect(x, y, Celda.TAMAÑO, Celda.TAMAÑO); // Rellena un rec�ngulo con las medidas de la clase Celda
					
					g.setColor(Color.BLACK);
					if(!aux[i][j].getMuro(0)) {
						g.drawLine(x, y, x+Celda.TAMAÑO, y); // Muro superior (N)
					}
					if(!aux[i][j].getMuro(1)) {
						g.drawLine(x+Celda.TAMAÑO, y, x+Celda.TAMAÑO, y+Celda.TAMAÑO); // Muro derecha (E)
					}
					if(!aux[i][j].getMuro(2)) {
						g.drawLine(x, y+Celda.TAMAÑO, x+Celda.TAMAÑO, y+Celda.TAMAÑO); // Muro inferior (S)
					}
					if(!aux[i][j].getMuro(3)) {
						g.drawLine(x, y, x, y+Celda.TAMAÑO); // Muro izquierda (O)
					}
				}
			}
			
		}
	}

}
