after "deploy:updated", "submodules:release"
after "deploy:updated", "wp:config"
after "deploy:updated", "gulp:make"
after "deploy:updated", "wp:cleanup"
after "deploy:updated", "shared:make_shared_dir"
after "deploy:updated", "shared:make_symlinks"
