# Build Status

[![NuGet](https://img.shields.io/nuget/v/GravatarHelper.NetStandard.svg)](https://www.nuget.org/packages/GravatarHelper.NetStandard/)

# Plataformas Suportadas

- .NET Standard 2.0

# Sobre

Um biblioteca [.Net standard library] que determina o tipo de mapeamento que deve ser feito para um arquivo.

Mais informações do pacote: https://www.nuget.org/packages/FileFormat/

# Exemplo de utilização

Para utilizar a biblioteca utilizando um Filestream, siga a sintaxe abaixo.

```csharp

var fileStream = File.Open("./file.json", FileMode.Open);
var mappingName = new FileFormat(fileStream).MappingName();

```

Você também pode utilizar apenas o caminho do servidor para a biblioteca.

```csharp

var filePath = "./file.json";
var mappingName = new FileFormat(filePath).MappingName();

```

## Licença

[Apache 2.0](https://github.com/BrunoBiluca/Cursos/blob/master/DotNetCore/FileFormatLibrary/src/FileFormat/license.txt)
