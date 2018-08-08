 public Object clone(Produto produto){
    Object object = null;
    try{
      FileOutputStream fileOutputStream = new FileOutputStream("object.dat");
      ObjectOutputStream objectOutputStream = new ObjectOutputStream(fileOutputStream);
      objectOutputStream.writeObject(produto);
      fileOutputStream.flush();
      fileOutputStream.close();
      objectOutputStream.flush();
      objectOutputStream.close();
      FileInputStream fileInputStream = new FileInputStream("object.dat");
      ObjectInputStream objectInputStream = new ObjectInputStream(fileInputStream);
      object = objectInputStream.readObject();
      fileInputStream.close();
      objectInputStream.close();
    }
    catch (Exception e){
      e.printStackTrace();
    }
    return object;
  }
