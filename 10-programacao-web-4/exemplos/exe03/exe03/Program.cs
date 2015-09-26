using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Exercicio3
{
    public class Bloco
    {
        public double Largura { get; private set; }
        public double Comprimento { get; private set; }
        public double Altura { get; private set; }

        private double? volume = null;
        private double? area = null;        

        public double Volume
        {
            get
            {
                volume = volume ?? Altura * Largura * Comprimento; 
                return volume.Value;
            }
        }

        public double Area { 
            get 
            {
                area = area ?? (2 * Largura * Comprimento) + (2 * Largura * Altura) + (2 * Comprimento * Altura);
                return area.Value; 
            } 
        }

        public Bloco(double largura, double comprimento, double altura)
        {
            this.Largura = largura;
            this.Comprimento = comprimento;
            this.Altura = altura;
        }
    }

    class Program
    {
        static void Main(string[] args)
        {
            Bloco bloco = new Bloco(4, 2, 6);
            Console.WriteLine("Volume do bloco é {0}", bloco.Volume);
            Console.WriteLine("Volume do bloco é {0}", bloco.Volume);
            Console.WriteLine("Área do bloco é {0}", bloco.Area);
        }
    }
}
