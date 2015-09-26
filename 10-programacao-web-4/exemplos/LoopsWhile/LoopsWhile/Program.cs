using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace LoopsWhile
{
    class Program
    {
        static void Main(string[] args)
        {
            var i = 0;
            for (; ; )
            {
                ++i;
                if (i == 5)
                    continue;
                
                Console.WriteLine("Feliz Aniversário {0}", i);
                
                if (i > 10)
                    break;
            }
        }
    }



    //Console.Write("Quantos anos você tem? ");
    //        byte idade = byte.Parse(Console.ReadLine());

    //        //for (byte i = 0; i < idade; i++)
    //        //{
    //        //    Console.Write("Feliz Aniversário Envelheço na Cidade ");
    //        //}

    //        for (; idade > 0; idade--)         
    //        {
    //            Console.Write("Feliz Aniversário Envelheço na Cidade ");
    //        }

    //            //while (idade > 0)
    //            //{
    //            //    Console.Write("Feliz Aniversário Envelheço na Cidade ");
    //            //    idade--;                
    //            //}                           

    //            Console.WriteLine("\n\n\n\tÉ big, é big, é hora...");

}
