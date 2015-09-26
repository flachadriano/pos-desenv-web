using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace ValoresBooleanos
{
    class Program
    {
        static void Main(string[] args)
        {
            var seraVerdade = 7 + 8 == 15;
            Console.WriteLine(seraVerdade);
            var seraMentira = 8 + 2 > 10;
            Console.WriteLine(seraMentira);

            var umaVerdadeInteira = seraVerdade && seraMentira;
            Console.WriteLine("Verdade Inteira: {0}", umaVerdadeInteira);

            var meiaVerdade = seraVerdade || seraMentira;
            Console.WriteLine("seraVerdade: {0} - seraMentira: {1} = Meia Verdade: {2}",
                            seraVerdade,
                            seraMentira,
                            meiaVerdade);

            var naoEMentira = !seraMentira;

            Console.WriteLine("Será mentira {0} -> não é mentira {1}", seraMentira, naoEMentira);


            Console.WriteLine("Salario: {0:C2}", 2500);


        }
    }
}
