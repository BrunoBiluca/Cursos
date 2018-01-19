using System;
using Microsoft.AspNetCore.Builder;
using Microsoft.AspNetCore.Hosting;
using Microsoft.AspNetCore.Http;

namespace CreateHost {
    class Program {
        static void Main(string[] args) {
            var host = new WebHostBuilder()
                .UseKestrel()
                .Configure(app => {
                    app.Run(context => context.Response.WriteAsync("Bão demais na mão"));
                })
                .Build();
            host.Run();
        }
    }
}
