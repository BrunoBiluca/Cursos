# Project Setup

## Tarefas
- &check; Configurar o input

## Descrição

Criar os inputs do jogo
- Project Settings
  - Input
    - Axis Mappings
      - Definir os mapeamentos também para o teclado
        - necessário adicionar o scale -1 para S e 1 para W
        - D = 1 e A = -1
      - Definir cada direção e o eixo desejado
        - LookUp
        - LookRight
        - MoveUp
        - MoveRight
    - Uma coisa que podemos melhorar na configuração padrão da UE é diminuir o Dead Zone do Axis Config


# Build the level

## Tarefas

- &check; Construir o cenário
  - &check; Construir a caixa
  - &check; Adicionar materials a caixa
  - &check; Adicionar uma Directional Light
  - &check; Adicionar uma Sky Light
  - &check; Adicionar Post Processing

## Aula

Construir uma caixa

Dimensões 2200 x 200 de largura

Alterar a métrica dos grids para 100 de forma a mudar a garantir a caixa fechada.

Geometry > Select > All with the same material

SkyLight > Source Type para um CubeMap

SkyLight são utilizadas para gerar uma luz de refração (Bounce Light), deixando o ambiente mais próximo do real

Post Processing > Unbound, fazemos isso para o post processing ser utilizado em todo o level. Esse post processing será utilizado para diminuir o Brilho da tela


# Framework Review

Revisão de como que funciona a UR4

- Actor: qualquer objeto colocado no mundo
  - Pawn: qualquer objeto que é controlado no mundo
    - Character:  classe utiliza mais para criar qualquer objeto que tem um formato humanóide. Uma instância de Character possui Character Movement Component, que possibilita a configurçaão do movimento da instância
- Component: parte de um Actor, cada componente tem suas propriedades
- Controller: mecanismo que executa o Actor
   - Player Controller
   - AI Controller
- Game Mode: classe reponsável por implementar as regras do jogo, utilizado para definir a configuração do jogo, por exemplo como o tipo de controle que será utilizado no jogo, ou o Score de um jogo.

# Build Character Class

## Tarefas
- _ Criar uma classe C++ Character, BaseCharacter
- _ Serar o ambiente do VS como Development
- _ Ler o documento que vem no tutorial com o código C++

















