import java.io.*;
import java.math.*;
import java.security.*;
import java.text.*;
import java.util.*;
import java.util.concurrent.*;
import java.util.function.*;
import java.util.regex.*;
import java.util.stream.*;
import java.net.*;
import com.google.gson.Gson;

import static java.util.stream.Collectors.joining;
import static java.util.stream.Collectors.toList;



class Result {
    static class MatchesResponse {
        public int page;
        public int per_page;
        public int total;
        public int total_pages;
        public ArrayList<MatchInfo> data = new ArrayList<>();
    }
    
    static class MatchInfo {
        public String team1;
        public String team2;
        public String team1goals;
        public String team2goals;
    }
    
    static MatchesResponse getMatches(String teamType, String team, int year, int page){
        try{
            String baseUrl = "https://jsonmock.hackerrank.com/api/football_matches";
            String urlStr = baseUrl + "?year=" + year + "&" + teamType + "=" + team.replace(" ", "%20") + "&page=" + page;
            URL url = new URL(urlStr);        
            HttpURLConnection con = (HttpURLConnection) url.openConnection();
            con.setRequestMethod("GET");
            con.setRequestProperty("accept", "application/json");
            
            BufferedReader in = new BufferedReader(new InputStreamReader(con.getInputStream()));
            String inputLine;
            StringBuffer content = new StringBuffer();
            while ((inputLine = in.readLine()) != null) {
                content.append(inputLine);
            }
            in.close();
            
            System.out.println(content.toString());   
            
            MatchesResponse response = new Gson().fromJson(content.toString(), MatchesResponse.class);
            return response;
        }
        catch (Exception ex){
            ex.printStackTrace();
        }
        return new MatchesResponse();
    }
    
    static int countGoals(ArrayList<MatchInfo> matches, String team){
        int totalGoals = 0;
        for (MatchInfo match : matches) {
            if(match.team1.equals(team)){
                totalGoals += Integer.parseInt(match.team1goals);
            }
            else if(match.team2.equals(team)){
                totalGoals += Integer.parseInt(match.team2goals);
            }
        }
        return totalGoals;
    }

    public static int getTotalGoals(String team, int year) {
        System.out.println(team + " " + year);
        int totalGoals = 0;

        int page = 1;
        MatchesResponse response = getMatches("team1", team, year, page);        
        totalGoals += countGoals(response.data, team);
        for (int i = page + 1; i <= response.total_pages; i++) {
            MatchesResponse r = getMatches("team1", team, year, i);        
            totalGoals += countGoals(r.data, team);            
        }
        
        page = 1;
        MatchesResponse response2 = getMatches("team2", team, year, page);
        totalGoals += countGoals(response2.data, team);        
        for (int i = page + 1; i <= response2.total_pages; i++) {
            MatchesResponse r = getMatches("team2", team, year, i);        
            totalGoals += countGoals(r.data, team);            
        }
        
        return totalGoals;
    }

}

public class Solution {
    public static void main(String[] args) throws IOException {
        BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(System.in));
        BufferedWriter bufferedWriter = new BufferedWriter(new FileWriter(System.getenv("OUTPUT_PATH")));

        String team = bufferedReader.readLine();

        int year = Integer.parseInt(bufferedReader.readLine().trim());

        int result = Result.getTotalGoals(team, year);

        bufferedWriter.write(String.valueOf(result));
        bufferedWriter.newLine();

        bufferedReader.close();
        bufferedWriter.close();
    }
}
