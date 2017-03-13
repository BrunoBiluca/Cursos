def fatorial (n)
	return 1 if n == 1
	n * fatorial(n-1)
end

# Uma função pode ter várias assinaturas
alias fac fatorial

puts fac(3)


def truncate (string, lenght=20)
	string[0, lenght-3] + "..."
end

puts truncate("Essa string já está muito longa então ela deve ter três pontinhos no final")