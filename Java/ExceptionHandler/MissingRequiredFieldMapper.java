import com.appsdeveloperblog.app.ws.ui.model.response.ErrorMessage;
import com.appsdeveloperblog.app.ws.ui.model.response.ErrorMessages;
import javax.ws.rs.core.Response;
import javax.ws.rs.ext.ExceptionMapper;
import javax.ws.rs.ext.Provider;

// Provider é importante para registrar este mapper no framework, assim quando uma exceção deste tipo for
// lançada o framework captura essa exceção e faz o mapper fazer a respostas
@Provider
public class MissingRequiredFieldExceptionMapper implements ExceptionMapper<MissingRequiredFieldException>{

    public Response toResponse(MissingRequiredFieldException exception) {
        ErrorMessage errorMessage = new ErrorMessage(exception.getMessage(),
                ErrorMessages.MISSING_REQUIRED_FIELD.name(), "http://appsdeveloperblog.com");
        
      return Response.status(Response.Status.BAD_REQUEST).entity(errorMessage).build();
    }
    
}
