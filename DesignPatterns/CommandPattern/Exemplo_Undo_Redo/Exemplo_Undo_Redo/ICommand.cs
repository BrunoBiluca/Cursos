namespace Exemplo_Undo_Redo { 
    public interface ICommand {
        void Execute();
        void Undo();
        void Redo();
    }
}
