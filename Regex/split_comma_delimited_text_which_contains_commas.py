import re

# This text must be splited in 3 values by comma
text = '11,"American President, The (1995)",Comedy|Drama|Romance'
print("Original: ", text)

# Find any comma that is outside of quoutes, if the quotes are balanced
regex_pattern = r",(?=(?:[^\"]*\"[^\"]*\")*[^\"]*$)"

# Replate the delimeters commas with another symbol
text = re.sub(regex_pattern, ";", text)
print("Replaced: ", text)