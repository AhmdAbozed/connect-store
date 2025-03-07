/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.ts",
    "./resources/**/*.vue",
  ],
  theme: {
  
    extend: {
      screens: {
        'xl': '1200px',  // Custom breakpoint at 400px
      },
      colors:{
        'gray-925': '#0D131F',
    
      },
      fontFamily: {
        'roboto': ['Roboto', 'sans-serif'],
      },
      keyframes: {
        fadeInOut: {
          '0%, 100%': { opacity: '0%' },
          '10%, 90%': { opacity: '100%' },
        },
        fadeIn: {
          '0%': { opacity: '0%' },
          '100%': { opacity: '100%' },
        },
        
        slideIn: {
          '0%': { transform: 'translateX(-100%)'},
          '100%': {  transform:'none' },
        },
       
        slideFadeIn: {
          '0%':{width:'12rem', opacity: '0%'},
          '100%':{width:'20rem', opacity: '100%'}

        }
      },
       boxShadow: {
        '3xl': 'rgba(0, 0, 0, 0.0) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;',
      },
      animation: {
        fadeIn: 'fadeIn 0.3s forwards',
        fadeInOut: 'fadeInOut 3s forwards',
        
        slideIn: 'slideIn 0.2s forwards',
        slideFadeIn: 'slideFadeIn 0.2s forwards',
       
      }
    },
  },
  plugins: [],
}