# Materiais no HDRP

## Refraction (Refração)

Simula uma material de vidro, também pode ser utilizado como água.

![](images/materials/refraction_sample.png)

Para utilizar o material do tipo reflexivo é necessário apenas trocar o tipo do material para transparente e depois aplicar o refraction model.

![](images/materials/refraction_inspector.png)

## Iridescence (Furta cor)

Simula um material que dependendo do ângulo que está sendo observação ele exibe uma cor. 

Podmeos ver esse efeito em vários materiais como bolhas de sabão, CDs, penas de certos animais.

![](images/materials/iridescence_sample.png)


![](images/materials/iridescence_inspector.png)

## Subsurface Scattering (Espalhamento de luz)

O subsurface Scattering, também conhecido como espalhamento de luz, é a propriedade que determina a difusão da luz em contato com uma superfície.

Muito utilizado em materiais para determinar as cores nas bordas dos objetos. Podemos ver esse efeitos principalmente nas pontas do corpo humano, como orelhas e dedos.

![](images/materials/subsurface_scaterring_sample.png)

![](images/materials/subsurface_scaterring_inspector.png)

É necessário atribuir um profile de difusão da luz para esses tipos de materiais.

![](images/materials/subsurface_scaterring_diffusion_profile.png)

## Anisotropic (Anisiotrópico)

![](images/materials/anisotropic_sample.png)

![](images/materials/anisotropic_inspector.png)

## Displacement (Deslocamento de pixel e vértice)

Permite alterar a malha do objeto de acordo com um Heigth map, ou seja, uma textura.

![](images/materials/displacement_inspector.png)

- Modo Vértice

Altera a malha do objeto.

- Modo Pixel

Alterar a posição dos pixels do objeto em relação a câmera.

## Decals

Máscaras que podemos aplicar sobre o mundo para exibir novas aparências. O decals está projetando um material sobre outro que está na cena.

O decal pode ser utilizado para exibir poças de água no chão.


![](images/materials/decals_sample.png)

![](images/materials/decals_create.png)

O material deve ser do tipo HDRP/Decal.

# Volumes

![](images/volumes/volumes_create.png)

## Physically Based Sky

![](images/volumes/physically_based_sky_inspector.png)

## Shadows (Sombras)

![](images/volumes/shadows_inspector.png)

## Ambiente Occlusion

![](images/volumes/ambiente_occlusion_inspector.png)

## Fog

![](images/volumes/fog_inspector.png)

## Volumentric Fog

![](images/volumes/volumetric_fog_inspector.png)
