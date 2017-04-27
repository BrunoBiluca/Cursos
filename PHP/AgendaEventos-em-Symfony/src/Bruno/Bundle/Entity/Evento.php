<?php

namespace Bruno\Bundle\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class Evento {

    /** @var string */
    private $titulo;

    /** @var string */
    private $descricao;

    /** @var DateTime */
    private $data;

    /** @var integer */
    private $criador;

    /** @var integer */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    public $image;

    private $file;

    public function getAbsolutePath() {
        return null === $this->image ? null : $this->getUploadRootDir() . '/' . $this->image;
    }

    public function getWebPath() {
        return null === $this->image ? null : $this->getUploadDir() . '/' . $this->image;
    }

    protected function getUploadRootDir() {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir() {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/documents';
    }

    /** Get name
     * @return string
     */
    function getName() {
        return $this->name;
    }

    /** Set name
     * @param string $name
     * @return Evento
     */
    function setName($name) {
        $this->name = $name;
    }

    /** Get id
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /** Set titulo
     * @param string $titulo
     * @return Evento
     */
    public function setTitulo($titulo) {
        $this->titulo = $titulo;

        return $this;
    }

    /** Get titulo
     * @return string
     */
    public function getTitulo() {
        return $this->titulo;
    }

    /** Set descricao
     * @param string $descricao
     * @return Evento
     */
    public function setDescricao($descricao) {
        $this->descricao = $descricao;

        return $this;
    }

    /** Get descricao
     * @return string
     */
    public function getDescricao() {
        return $this->descricao;
    }

    /** Set data
     * @param \DateTime $data
     * @return Evento
     */
    public function setData(\DateTime $data) {
        $this->data = $data;

        return $this;
    }

    /** Get data
     * @return \DateTime
     */
    public function getData() {
        return $this->data;
    }

    /** Set criador
     * @param integer $criador
     * @return Evento
     */
    public function setCriador($criador) {
        $this->criador = $criador;

        return $this;
    }

    /** Get criador
     * @return integer
     */
    public function getCriador() {
        return $this->criador;
    }

    function getImage() {
        return $this->image;
    }

    function setImage($image) {
        $this->image = $image;
    }

    /** Sets file.
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null) {
        $this->file = $file;
    }

    /** Get file.
     * @return UploadedFile
     */
    public function getFile() {
        return $this->file;
    }

    public function Upload() {
        // the file property can be empty if the field is not required
        if (null === $this->getFile()) {
            return;
        }

        // use the original file name here but you should
        // sanitize it at least to avoid any security issues
        // move takes the target directory and then the
        // target filename to move to
        $this->getFile()->move(
                $this->getUploadRootDir(), $this->getFile()->getClientOriginalName()
        );

        // set the path property to the filename where you've saved the file
        $this->image = $this->getFile()->getClientOriginalName();

        // clean up the file property as you won't need it anymore
        $this->file = null;
    }

}
