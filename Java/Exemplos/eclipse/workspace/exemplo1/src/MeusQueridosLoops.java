public class MeusQueridosLoops {
	
	public static int fatorial(int n){
		int result;
		if(n==0){
			return 1;
		}else{
			result = n*fatorial(n-1);
		}
		return result;
	}
	
	public static void main(String[] args) {
		for(int i=150;i<=300;i++){
			System.out.println(i);
		}
		int soma = 0;
		for(int i=1;i<=1000;i++){
			soma = soma + i;
		}	
		System.out.println(soma);
		for (int i = 1; i < 100; i++) {
			if(i%3==0){
				System.out.println(i);
			}
		}
		
		System.out.println(fatorial(6));
	}
}
