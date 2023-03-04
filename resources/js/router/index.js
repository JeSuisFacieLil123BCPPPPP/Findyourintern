
import Vue from 'vue';
import VueRouter from 'vue-router';
import store from '../store/index';
//import Example from '../components/ExampleComponent.vue'
Vue.use(VueRouter)


const Routes = [
    {
        path: '/admin',
        component: () => import('../components/Layout/DashboardAdminLayout.vue'),
        name: 'admin',
        meta: {
            middleware: "admin",
        },
        children: [
            {
                path: 'dashboard',
                component: () => import('../components/Dashboard/AdminDashboard.vue'),
                name: 'dashboard',
                meta: {
                    middleware: "admin",
                },
            },
            {
                path: 'users',
                component: () => import('../components/Users.vue'),
                name: 'users',
                meta: {
                    middleware: "admin",
                },
            },
            {
                path: 'categories',
                component: () => import('../components/Categories.vue'),
                name: 'categories',
                meta: {
                    middleware: "admin",
                },
            },
            {
                path: 'subcategories',
                component: () => import('../components/Subcategories.vue'),
                name: 'subcategories',
                meta: {
                    middleware: "admin",
                },
            },
            {
                path: 'realisations',
                component: () => import('../components/Realisations.vue'),
                name: 'realisations',
                meta: {
                    middleware: "admin",
                },
            },
        ]
    },
    {
        path: '/moli',
        component: () => import('../components/ExampleComponent.vue'),
        name: 'nmoli',
        meta: {
            middleware: "guest",
        },
    },
    {
        path: '/mana',
        component: () => import('../components/mana.vue'),
        name: 'naa',
        meta: {
            middleware: "guest",
        },
    },
    {


        path: '/nathe',
        component: () => import('../components/nathe.vue'),
        name: 'nathe',
        meta: {
            middleware: "guest",
        },
        children: [
            {
                path: 'conversation/:id',
                name: 'conversation',
                component: () => import('../components/Messagerie/MessagePage.vue'),
                props: true,

            },
            {
                path: 'conversation-page/:userRecId',
                name: 'conversation-page',
                component: () => import('../components/Messagerie/MessagePage.vue'),
                meta: {
                    middleware: "auth",
                },
                props: true,

            }
        ],

    },
    {
        path: '/',
        component: () => import('../views/appli.vue'),
        name: 'appli',
        meta: {
            middleware: "guest",
        },


        children: [
            {
                path: 'accueil',
                component: () => import('../components/Accueil.vue'),
                name: 'accueil',
                meta: {
                    middleware: "guest",
                },
            },
            {
                path: 'register2',
                component: () => import('../components/Register1.vue'),
                name: 'register2',
                meta: {
                    middleware: "guest",
                },
            },
            {
                path: 'create/realisations',
                component: () => import('../components/Realisations/RealisationsAd.vue'),
                name: 'createrealisations',
                meta: {
                    middleware: "auth",
                },
            },
            {
                path: 'student/myprofile',
                component: () => import('../components/Students/StudentProfile.vue'),
                name: 'studentProfile',
                props: true,
                meta: {
                    middleware: "auth",
                },
            },
            {
                path: 'recherche/student/profile/:userId',
                component: () => import('../components/Students/ProfilDetails.vue'),
                name: 'profileStudentDetails',
                props: true,
                meta: {
                    middleware: "auth",
                },
            },
            {
                path: 'student/myprofile/createcv/:userId',
                component: () => import('../components/Students/CreateCV.vue'),
                name: 'createcv',
                props: true,
                meta: {
                    middleware: "auth",
                },
            },
            {
                path: 'create/offre0',
                component: () => import('../components/Entreprises/Publier_offre.vue'),
                name: 'postingOffre0',
                meta: {
                    middleware: "auth",
                },
            },
            {
                path: 'choice/posting',
                component: () => import('../components/Entreprises/ChoixPublier.vue'),
                name: 'choixPosting',
                meta: {
                    middleware: "auth",
                },
            },
            {
                path: 'success/posting',
                component: () => import('../components/Entreprises/SuccessPosting.vue'),
                name: 'successPosting',
                meta: {
                    middleware: "auth",
                },
            },
            {
                path: 'success/postuler',
                component: () => import('../components/Postuler/SuccessPostuler.vue'),
                name: 'successPostuler',
                meta: {
                    middleware: "auth",
                },
            },
            {
                path: 'p/posting/',
                component: () => import('../components/Entreprises/Publier_Offre-1.vue'),
                name: 'postingOffre',
                meta: {
                    middleware: "auth",
                },
                props: route => ({
                    step: route.query.step,
                    index: route.query.index,
                    offreModele: route.query.offreModele
                  }),
                query: {
                    step: 'getting-started',
                }
            },
            {
                path: 'companies/details/',
                component: () => import('../components/Entreprises/CompanyDetails.vue'),
                name: 'detailsCompany',
                meta: {
                    middleware: "auth",
                },
                props: route => ({
                   company: route.query.company,
                  }),
                  query:{company:null}
            },
            {
                path: 'companies/all/',
                component: () => import('../components/Entreprises/Companies.vue'),
                name: 'companiesAll',
                meta: {
                    middleware: "auth",
                },
            },
            {
                path: 'offres/all',
                component: () => import('../components/Entreprises/Offres_Publie.vue'),
                name: 'alloffres',
                meta: {
                    middleware: "auth",
                },
            },
            {
                path: 'list/realisations',
                component: () => import('../components/Realisations/List.vue'),
                name: 'listrealisations',
                meta: {
                    middleware: "auth",
                },
            },
            {
                path: 'realisationsStudents',
                component: () => import('../components/Realisations/RealisationsPrinc.vue'),
                name: 'realisationprinc',
                meta: {
                    middleware: "guest",
                },
                query: {
                    search: '',
                }

            },
            {
                path: 'portfolios',
                component: () => import('../components/Portfolio/PortfoliosLibre.vue'),
                name: 'portfolioPrinc',
                meta: {
                    middleware: "guest",
                },
            },
            {
                path: 'realisationsRecherche',
                component: () => import('../components/Recherche/PageRechercheRealisation.vue'),
                name: 'realisationsrecherche',
                meta: {
                    middleware: "guest",
                },
                query: {
                    search: '',

                }

            },
            {
                path: 'offresRecherche',
                component: () => import('../components/Recherche/PageRechercheOffre.vue'),
                name: 'offresrecherche',
                meta: {
                    middleware: "guest",
                },
                query: {
                    search: '',
                }

            },
            {
                name: "login",
                path: 'login',
                component: () => import('../components/Login.vue'),
                meta: {
                    middleware: "guest",
                },
            },
            {
                name: "register",
                path: '/register',
                component: () => import('../components/Register.vue'),
                meta: {
                    middleware: "guest",
                },
            },
            {
                name: "test12",
                path: '/test12',
                component: () => import('../components/Entreprises/testChamp.vue'),
                meta: {
                    middleware: "guest",
                },
            },
            {
                path: 'realisation/:realisationId',
                component: () => import('../components/Realisations/RealisationDetails.vue'),
                name: 'realisationdetails', props: true,
                meta: {
                    middleware: "guest",
                },
            },
            {
                path: 'offre/:offreId',
                component: () => import('../components/Entreprises/Details_Offre.vue'),
                name: 'offredetails',
                props: true,
                meta: {
                    middleware: "guest",
                },
            },//Offres_Postulant_Page.vue
            {
                path: 'dossier/:offreId',
                component: () => import('../components/Dossiers/MonDossier.vue'),
                name: 'dossierdetails',
                props: true,
                meta: {
                    middleware: "guest",
                },
            },
            {
                path: 'create/porfolio',
                component: () => import('../components/Portfolio/create.vue'),
                name: 'portfolio',
                props: true,
                meta: {
                    middleware: "guest",
                },
            },
            {
                path: 'mesdossiers',
                component: () => import('../components/Dossiers/MesDossiers.vue'),
                name: 'mesdossiers',
                props: true,
                meta: {
                    middleware: "guest",
                },
            },
            {
                path: 'postuler/:offreId',
                component: () => import('../components/Postuler/Postuler.vue'),
                name: 'postuler',
                props: true,
                meta: {
                    middleware: "auth",
                },
            },
            {
                path: 'details/:offreId',
                //component: () => import('../components/Postuler/Offre_Postulant_Comp.vue'),
                // components:() => import('../components/Postuler/Offre_Postulant_Comp.vue'), // this will override the default                         
                component: () => import('../components/Postuler/Offre_Postulant_Comp.vue'),
                name: 'postulants',
                props: true,
                meta: {
                    middleware: "auth",
                },
            },//RechercheProfilesStudents.vue
            {
                path: 'rechercheProfilesStudents',
                component: () => import('../components/Students/RechercheProfilesStudents.vue'),
                name: 'rechercheProfilesStudents',
                query: {
                   
                },
                /* props: (route) => ({ offreId: route.query.offreId,
                     postulantId: route.query. postulantId}) ,*/
                meta: {
                    middleware: "auth",
                },
            },
            {
                path: 'reponse/:offreId/:postulantId',
                component: () => import('../components/Postuler/Reponse.vue'),
                // components: Reponse, // this will override the default

                name: 'reponsePostuler',
                props: true,
                /* props: (route) => ({ offreId: route.query.offreId,
                     postulantId: route.query. postulantId}) ,*/
                meta: {
                    middleware: "auth",
                },
            },
            {
                path: 'details/:offreId/:postulantId',
                component: () => import('../components/Postuler/PostulantPostDetails.vue'),
                // components: Reponse, // this will override the default

                name: 'voirPostulantPost',
                props: true,
                /* props: (route) => ({ offreId: route.query.offreId,
                     postulantId: route.query. postulantId}) ,*/
                meta: {
                    middleware: "auth",
                },
            },
            {
                path: 'offres/postulants',
                component: () => import('../components/Offres_Postulant_Page-1.vue'),
                name: 'offres_postulants',
                meta: {
                    middleware: "guest",
                },
                children: [
                    {
                        path: 'details/:offreId',
                        //component: () => import('../components/Postuler/Offre_Postulant_Comp.vue'),
                        // components:() => import('../components/Postuler/Offre_Postulant_Comp.vue'), // this will override the default                         
                        component: () => import('../components/Postuler/Offre_Postulant_Comp.vue'),
                        name: 'postulants',
                        props: true,
                        meta: {
                            middleware: "auth",
                        },
                    },//
                    {
                        path: 'reponse/:offreId/:postulantId',
                        component: () => import('../components/Postuler/Reponse.vue'),
                        // components: Reponse, // this will override the default

                        name: 'reponsePostuler',
                        props: true,
                        /* props: (route) => ({ offreId: route.query.offreId,
                             postulantId: route.query. postulantId}) ,*/
                        meta: {
                            middleware: "auth",
                        },
                    },
                    {
                        path: 'details/:offreId/:postulantId',
                        component: () => import('../components/Postuler/PostulantPostDetails.vue'),
                        // components: Reponse, // this will override the default

                        name: 'voirPostulantPost',
                        props: true,
                        /* props: (route) => ({ offreId: route.query.offreId,
                             postulantId: route.query. postulantId}) ,*/
                        meta: {
                            middleware: "auth",
                        },
                    },
                ]
            },
            /* {
                 path: 'reponse',
                 //component: () => import('../components/Postuler/Offre_Postulant_Comp.vue'),
                 components:() => import('../components/Postuler/Children/Reponse.vue'), // this will override the default
                  
                 name: 'reponsePostuler', 
                 //props: true,
                 query:{
                     offreId:null,
                     postulantId:null,
 
                 },
                 meta: {
                     middleware: "auth",
                 },
             },*/
            /* {
                 path: 'offres/:offreId',
                 component: () => import('../components/Postuler/Postuler.vue'),
                 name: 'postuler', 
                 props: true,
                 meta: {
                     middleware: "guest",
                 },
                 
             },*/

            {
                path: '/reset-password',//./components/Users/ForgotPassword.vue
                name: 'reset-password',
                component: () => import('../components/Users/ForgotPassword.vue'),
                meta: {
                    middleware: "guest",
                },
            },

            {
                path: '/reset-password/:token',
                name: 'reset-password-form',
                component: () => import('../components/Users/ResetPasswordForm.vue'),
                meta: {
                    middleware: "guest",
                },

            },
            {
                path: '/userprofile',
                component: () => import('../components/Users/UserProfile.vue'),
                name: 'userProfile',
                meta: {
                    middleware: "auth",
                },
            },

            //./components/Users/ForgotPassword.vue
            /* {
                 path: '/admin/categories',
                 component: () => import('../components/Categories.vue'),
                 name: 'categories',
                 meta: {
                     middleware: "guest",
                 },
             },*/
            /* {
                 name: "login",
                 path: '/login',
                 component: () => import('../components/Login.vue'),
                 meta: {
                     title: `login`,
                     middleware: "guest",
                 }
             },
             {
                 name: "register",
                 path: '/register',
                 component: () => import('../components/Register.vue'),
                 meta: {
                     title: `login`,
                     middleware: "guest",
                 }
             },
             {
                 path: '/realisation/:realisationId',
                 component: () => import('../components/Realisations/RealisationDetails.vue'),
                 name: 'realisationdeatails', props: true
 
             }*/
            /* {
                path: '*',
                component: () =>import ( '../views/NotFound.vue'),
               name: 'error'
               },*/
        ]
    }, {
        path: '/nathe',
        component: () => import('../components/ExampleComponent.vue'),
        name: 'nathe',
    },

    {
        path: '/specialappli/',
        component: () => import('../views/Specialappli.vue'),
        name: 'specialappli',
        meta: {
            middleware: "guest",
        },

        children: [
            {
                path: 'realisations',
                component: () => import('../components/Realisations/RealisationsAd.vue'),
                name: 'realisations',
                meta: {
                    middleware: "auth",
                },
            },
            {
                path: 'userprofile',
                component: () => import('../components/Users/UserProfile.vue'),
                name: 'userProfile',
                meta: {
                    middleware: "auth",
                },
            },
            {
                path: 'reset-password/:token',
                name: 'reset-password-form',
                component: () => import('../components/Users/ResetPasswordForm.vue'),
                meta: {
                    middleware: "guest",
                },

            },
            {
                path: 'forgot-password',
                name: 'forgot-password-form',
                component: () => import('../components/Users/ForgotPassword.vue'),
                meta: {
                    middleware: "guest",
                },

            },
            {
                path: 'message-page/:userRecId',
                name: 'message-page',
                component: () => import('../components/Messages/MessagePage.vue'),
                meta: {
                    middleware: "auth",
                },
                props: true,

            }

        ]
    },
    {
        // will match everything
        path: '/unauthorized',
        name: 'notauthorized',
        // path: 'notauthorized',
        component: () => import('../components/Results/NotAuthorized.vue'),
    },
    {
        // will match everything
        path: '*',
        component: () => import('../components/Results/NotFound.vue'),
    },
    /*  {
          path: '/specialappli',
          component: () => import('../views/Specialappli.vue'),
          name: 'specialappli',
          meta: {
              middleware: "guest",
          },
           children:[
                {
                    path: '/specialappli/:realisationId',
                    component: () => import('../components/Realisations/RealisationDetails.vue'),
                    name: 'realisationdeatails',
                },
             
                
            ]
  
      },*/

    /*  children:[
          {
              path: '/specialappli/:realisationId',
              component: () => import('../components/Realisations/RealisationDetails.vue'),
              name: 'realisationdeatails',
          },
          
      ]*/




]


var router = new VueRouter({
    mode: 'history',
    routes: Routes
})


router.beforeEach((to, from, next) => {
    if (to.meta.middleware == 'auth' && store.state.auth.authenticated == false) next({ name: 'login' })
    // else if(to.meta.middleware == 'auth' && store.state.auth.authenticated == true) next()
    // else if(to.meta.middleware == 'admin' && store.state.auth.authenticated == false)
    //next({ name: 'login' })
    // else if(to.meta.middleware == 'admin' && store.state.auth.authenticated == true && store.state.user.user_type=='admin')
    //  next()
    /*else if(to.meta.middleware == 'admin' && store.state.auth.authenticated == true && store.state.user.user_type!='admin')
    next({ name: 'notauthorized' })*/
    else next()
})

/* router.beforeEach((to, from, next) => {
    //document.title = `${to.meta.title} - ${process.env.MIX_APP_NAME}`
    if (to.meta.middleware == "guest") {
        if (store.state.authenticated) {
            next()
        }
         next()
    } else {
        if (store.state.authenticated) {
            alert(store.state.user.user_type)
            switch (store.state.user.user_type) {
                case 'admin':
                    next('/admin')
                    break;
                case 'student':
                    next('/specialappli')
                    break;
                case 'company':
                    next('/specialappli')
                    break;
                default:
                    next('/')
                    break;
            }
            next()
        } else {
            next({ name: "login" })
        }
    }
})*/

export default router