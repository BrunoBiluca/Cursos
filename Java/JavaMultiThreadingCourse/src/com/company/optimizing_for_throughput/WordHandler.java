package com.company.optimizing_for_throughput;

import com.sun.net.httpserver.HttpExchange;
import com.sun.net.httpserver.HttpHandler;

import java.io.IOException;
import java.nio.charset.StandardCharsets;

public class WordHandler implements HttpHandler {

    private final String text;

    public WordHandler(String text) {
        this.text = text;
    }

    @Override
    public void handle(HttpExchange exchange) throws IOException {

        var actionString = exchange.getRequestURI().getQuery().split("=");
        var action = actionString[0];
        var word = actionString[1];

        int wordCount = wordCount(word);

        var response = Long.toString(wordCount).getBytes(StandardCharsets.UTF_8);
        exchange.sendResponseHeaders(200, response.length);

        var outStream = exchange.getResponseBody();
        outStream.write(response);
        outStream.close();
    }

    private int wordCount(String word) {
        var wordCount = 0;
        var index = 0;
        while(index >= 0){
            index = text.indexOf(word, index);

            if(index >= 0){
                wordCount++;
                index++;
            }
        }
        return wordCount;
    }
}
