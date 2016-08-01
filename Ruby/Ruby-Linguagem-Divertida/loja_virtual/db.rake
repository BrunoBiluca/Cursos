#!/usr/bin/env rake

require 'fileutils'

namespace :db do
	desc "Limpa todas as revistas da pasta db/revistas"
	task :clear, [:folder] do |task, args|
		FileUtils.rm Dir["db/#{ args.folder }/*.yml"]
	end
end