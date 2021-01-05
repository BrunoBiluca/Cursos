import java.io.*;
import java.math.*;
import java.security.*;
import java.text.*;
import java.util.*;
import java.util.concurrent.*;
import java.util.regex.*;

public class Solution {

    public static String repeat(int count, String with){
      return new String(new char[count]).replace("\0", with)
    }

    // Complete the staircase function below.
    static void staircase(int n) {
        for(int i = 1;i <= n; i++){
            String emptySpace = new String(new char[n - i]).replace("\0", " ");
            String degrees = new String(new char[i]).replace("\0", "#");
            System.out.println(emptySpace + degrees);
        }

    }

    private static final Scanner scanner = new Scanner(System.in);

    public static void main(String[] args) {
        int n = scanner.nextInt();
        scanner.skip("(\r\n|[\n\r\u2028\u2029\u0085])?");

        staircase(n);

        scanner.close();
    }
}
