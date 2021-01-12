package br.biluca.download_upload_example;

import org.springframework.http.MediaType;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;
import org.springframework.web.multipart.MultipartFile;

import java.io.File;
import java.io.FileOutputStream;
import java.io.IOException;

@RestController
public class FileUploadController {
    @RequestMapping(value = "/upload", method = RequestMethod.POST,
            consumes = MediaType.MULTIPART_FORM_DATA_VALUE)

    public String fileUpload(@RequestParam("file") MultipartFile file) throws IOException {
        var tmpDirectory = "var/tmp/";
        boolean bool = new File(tmpDirectory).mkdirs();

        var convertFile = new File(tmpDirectory + file.getOriginalFilename());
        convertFile.createNewFile();

        var fileOutputStream = new FileOutputStream(convertFile);
        fileOutputStream.write(file.getBytes());
        fileOutputStream.close();
        return "File is upload successfully";
    }
}