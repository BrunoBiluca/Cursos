# Materiais no HDRP

## Refraction (Refra��o)

Simula uma material de vidro, tamb�m pode ser utilizado como �gua.

![](images/materials/refraction_sample.png)

Para utilizar o material do tipo reflexivo � necess�rio apenas trocar o tipo do material para transparente e depois aplicar o refraction model.

![](images/materials/refraction_inspector.png)

## Iridescence (Furta cor)

Simula um material que dependendo do �ngulo que est� sendo observa��o ele exibe uma cor. 

Podmeos ver esse efeito em v�rios materiais como bolhas de sab�o, CDs, penas de certos animais.

![](images/materials/iridescence_sample.png)


![](images/materials/iridescence_inspector.png)

## Subsurface Scattering (Espalhamento de luz)

O subsurface Scattering, tamb�m conhecido como espalhamento de luz, � a propriedade que determina a difus�o da luz em contato com uma superf�cie.

Muito utilizado em materiais para determinar as cores nas bordas dos objetos. Podemos ver esse efeitos principalmente nas pontas do corpo humano, como orelhas e dedos.

![](images/materials/subsurface_scaterring_sample.png)

![](images/materials/subsurface_scaterring_inspector.png)

� necess�rio atribuir um profile de difus�o da luz para esses tipos de materiais.

![](images/materials/subsurface_scaterring_diffusion_profile.png)

## Anisotropic (Anisiotr�pico)

![](images/materials/anisotropic_sample.png)

![](images/materials/anisotropic_inspector.png)

## Displacement (Deslocamento de pixel e v�rtice)

Permite alterar a malha do objeto de acordo com um Heigth map, ou seja, uma textura.

![](images/materials/displacement_inspector.png)

- Modo V�rtice

Altera a malha do objeto.

- Modo Pixel

Alterar a posi��o dos pixels do objeto em rela��o a c�mera.

## Decals

M�scaras que podemos aplicar sobre o mundo para exibir novas apar�ncias. O decals est� projetando um material sobre outro que est� na cena.

O decal pode ser utilizado para exibir po�as de �gua no ch�o.


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
