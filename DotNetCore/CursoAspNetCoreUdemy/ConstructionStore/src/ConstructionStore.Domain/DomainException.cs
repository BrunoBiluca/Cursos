using System;

namespace ConstructionStore.Domain {
    public class DomainException : Exception {
        public DomainException(string error) : base(error){

        }

        public static void When(bool hasError, string messageError){
            if(hasError)
                throw new DomainException(messageError);
        }
    }
}