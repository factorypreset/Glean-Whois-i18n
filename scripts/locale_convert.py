import getopt, sys, re, os, string, shutil


def extract_php_strings(source_file):
    
    php_strings = {}
    
    try:
        f = open(source_file)
    except Exception, e:
        print str(e)
        sys.exit(2)
        
    # clean the file content
    
    content = f.read()
    
    # remove php gumph
    php_re = re.compile(r'(\<\?php|\<\?|\?\>)', re.IGNORECASE)
    content = php_re.sub("", content)
    
    # remove comments
    comment_re = re.compile(r'\/\/(.*)\n', re.IGNORECASE)
    content = comment_re.sub("", content)
    
    # strip out whitespace
    whitespace_re = re.compile(r'(\n|\r)')
    content = whitespace_re.sub("", content)
    
    # split on semicolons (let's assume all semicolons are php syntax)
    messages = content.split(";")
    
    for message in messages:
        parts = message.split("=", 1)
        if len(parts) > 1:
            key = parts[0]
            val = parts[1]
            php_strings[key] = val  
    f.close()
    return php_strings


def find_php_files(path, subdirs):
    php_files = []
    os.chdir(path)
    for f in os.listdir("."):
        if f.endswith(".php"):
            php_files.append(f)
    
    # ugly
    for subdir in subdirs:
        os.chdir(path + '/' + subdir)
        for f in os.listdir("."):
            if f.endswith(".php"):
                php_files.append(subdir + "/" + f)
    
    return php_files

    
def convert_php_files(php_strings, path, php_files):
    for p in php_files:
        filename = path + '/' + p
        bak_filename = filename + '.bak'
        shutil.move(filename, bak_filename)
        bf = open(bak_filename, 'r')
        content = bf.read()
        print php_strings
        for key in php_strings:
            val = "_(" + php_strings[key] + ")"
            k = key + ";"
            v = val + ";"
            content = content.replace(k, v)
            print "replacing " + k + " with " + v
        bf.close()
        
        f = open(filename, 'w')
        f.write(content)
        f.close()


def usage():
    print "Usage for locale_convert.py:"
    print "  locale_convert.py -f /path/to/your/project/en_us.php -p /path/to/your/project"


def main():
    
    # get args
    try:
        opts, args = getopt.getopt(sys.argv[1:], "f:p:")
    except Exception, e:
        print str(e)
        usage()
        sys.exit(2)
    source_file = None
    path = None
    for o, a in opts:
        if o == "-f":
            source_file = a
            print "source file is", source_file
        elif o == "-p":
            path = a
            print "path is", path
        else:
            assert False, "unhandled option"
    if source_file == None or path == None:
        usage()
        sys.exit(2)
    
    # load source file and convert it
    php_strings = extract_php_strings(source_file)
    # print php_strings
    
    # find all php files in dir and various subdirs
    subdirs = ['includes', 'stuff', 'sidebar_pkg']
    php_files = find_php_files(path, subdirs)
    
    convert_php_files(php_strings, path, php_files)

if __name__ == "__main__":
    main()

    
    


