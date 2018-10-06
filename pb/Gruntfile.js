module.exports = function (grunt) {

  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-watch');

  grunt.initConfig({
    
    clean: {
      dist: [
        './dist',
      ]
    },
    
    uglify: {
      build: {
        files: {
          './dist/pb.calendar.min.js': './src/pb.calendar.js',
        }
      }
    },

    less : {
      build : {
        options : {
          ieCompat : true,
          paths: ["./css/"]
        },
        files: {
          './css/pb.calendar.css': './less/pb.calendar.less',
        }
      }
    },

    cssmin : {
      target: {
        files: {
          './css/pb.calendar.min.css': './css/pb.calendar.css'
        }
      }
    },

    watch: {
      js : {
        files: [
          './src/pb.calendar.js'
        ],
        tasks: ['uglify']
      },
      less : {
        files: [
          './less/pb.calendar.less'
        ],
        tasks: ['less', 'cssmin']
      }
    },
  });

  grunt.registerTask('dist', ['clean','uglify','less','cssmin']);
  grunt.registerTask('default', ['dist']);

};
