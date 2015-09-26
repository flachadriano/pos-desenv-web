using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace BlocoDeConstrucao
{
    class Program
    {
        static void Main(string[] args)
        {   
            string minhaString = "Olá Mundão!";
            char meuCaracter = '\n';
            Console.WriteLine(minhaString);

            int valorInteiro = 10;
            Console.WriteLine(valorInteiro);
            Console.WriteLine("{0:D5}", valorInteiro);

            double valorDouble = 4.20D;
            double soma = valorDouble + valorInteiro;

            float valorFloat = 4.20F;
            decimal outroValorFracionado = 4.20M;

            double x = valorDouble + valorFloat;

            Console.WriteLine("{0} + {1} = {2}",
                            valorDouble,
                            valorInteiro,
                            soma);     

        }
    }
}
