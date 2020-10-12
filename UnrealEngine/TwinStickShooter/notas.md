# Ideias para adicionar ao jogo

- _ Criar inimigos com vidas diferentes, a vida de cada inimigo será randomizada em 3, inimigos amerelos, laranjas e vermelhos
- _ Criar um tiro concentrado que atinge vários inimigos

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
- &check; Criar uma classe C++ Character, BaseCharacter
- &check; Serar o ambiente do VS como Development
- &check; Ler o documento que vem no tutorial com o código C++

# Build the Hero Character

SprintArm é um componente que garante a distantes em objetos, para eles sempre manterem a mesma distância, será utilizado entre o personagem principal e a câmera.

## Tarefas

- &check; Criar blueprint HeroCharacter que estende de BaseCharacter
- &check; Adicionar o mesh component como o manneguin
- &check; Garantir que o personagem está de frente para a direção correta
- &check; Adicionar o componente SprintgArm
- &check; Adicionar uma câmera
- &check; Criar um objeto de PlayerStart
- &check; Criar classe GameMode, TwinStickMode e adicionar o player como default
- v Alterar Default Maps para adicionar a Arena

# Player Mobility

Para controlar os character implementamos os eventos Input Axis, e precisamos garantir que os eixos estão corretos

Podemos criar boxes de comentários em nosso código para garantir claresa no código.

Podemos clicar duas vezes na mesma linha para criar um ReRoute point, um ponto para juntar várias linhas.

Cada nó no blueprint podemos clicar para expandir todas as suas funcionalidades.

## Tarefas

- &check; InputAxis MoveUp, MoveRight
   - Add MovementInput
- &check; InputAxis LookUp, MoveRight
- &check; GetController, SetControllerRotation, RotationFromXVector

# Building the Enemy Character

Para alterar a cor abrimos o Skeleton mesh para alterar o material que o boneco é feito.

Podemos promover valores para uma variável

## Tarefas

- &check; Criar EnemyCharacter
- &check; Alterar cor para os inimigos
- &check; Construction Script
   - Create Dynamic Material Instance
   - Set Vector Paramter Value
- &check; Criar um Blueprint para a AI Controller do Enemy
- Criar evento customizado TrackPlayer
   - AI Move To
   - Get Controlled Pawn
   - Get Player Character
   - Event BeginPlay >> SetTimer, TrackPlayer de 1 em 1 segundo
- Alterar o Controller AI nas referencias da classe
- Adicionar NavMesh
- Alterar Walk Speed para 200

# Projectile

Para o projétil vamos fazer um shader que apenas emite luz e nunca recebe nenhuma, para isso atualizamos o Shader Model para **Unlit**.

Para definir os eventos para instanciar os projéteis, iremos criar 3 eventos:

- PullTrigger: PullTrigger chama Fire
- ReleaseTrigger
- Fire: instancia o tiro
  - SpawnActor: Projectile

## Tarefas

- _ Criar um blueprint para o Projectile
  - Sphere collision
  - Ajustar o tamanho do raio da sphere
  - Adicionar mesh, No collision
  - Adicionar um projectile movement
 
- _ Criar o material de laser
  - Sharding model Unlit
  - GlowIntensity
- _ Criar um blueprint para a arma
  - Adicionar um skeleton mesh
  - Adicionar um arrow para definir o local que se  instancia os projéties
  - Criar o script para instanciar o projétil
- Adicionar a arma ao personagem
  - BeginPlay > Sequence > SpawnActor Weapon






