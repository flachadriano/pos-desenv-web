using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Exercicio02
{
    class Program
    {
        static void Main(string[] args)
        {
            Console.Write("Frase: ");
            var frase = Console.ReadLine();

            var soma = 0;             
            var numeroString = string.Empty;            

            for (var i = 0; i < frase.Length; i++)
            {   
                if (frase[i] >= '0' && frase[i] <= '9')
                    numeroString += frase[i];
                else if (numeroString != string.Empty)
                {
                    soma += int.Parse(numeroString);
                    numeroString = string.Empty;
                }
            }

            if (numeroString != string.Empty)
                soma += int.Parse(numeroString);

            Console.WriteLine("O valor total é: {0}", soma);
        }
    }
}
