<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class LoginFormAthenticatorAuthenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait;

    public const LOGIN_ROUTE = 'app_login';

    private UrlGeneratorInterface $urlGenerator;

    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    public function authenticate(Request $request): Passport
    {
        $email = $request->request->get('email', '');

        $request->getSession()->set(Security::LAST_USERNAME, $email);

        return new Passport(
            new UserBadge($email),
            new PasswordCredentials($request->request->get('password', '')),
            [
                new CsrfTokenBadge('authenticate', $request->request->get('_csrf_token')),
            ]
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
            return new RedirectResponse($targetPath);
        }

        $user = $token->getUser();


       if (in_array('ROLE_ADMIN', $user->getRoles())) {
            // Redirect to the app_admin page
          return new RedirectResponse($this->urlGenerator->generate('app_index_admin'));
        }  
        if (in_array('ROLE_DOCENTE', $user->getRoles())){
            return new RedirectResponse($this->urlGenerator->generate('app_index_docente'));
            
        } else {
            // Redirect to the app_user page
           
                return new RedirectResponse($this->urlGenerator->generate('app_index_estudiante'));
                
            }
               
            {
                return new RedirectResponse($this->urlGenerator->generate('app_login'));
            }
  //  if($user instanceof ROLE_DOCENTE) {
    //    return new RedirectResponse($this->urlGenerator->generate('app_docente_index'));
   // }
//else 
  //  if($user instanceof ROLE_ADMIN) {
    //    return new RedirectResponse($this->urlGenerator->generate('app_user_index'));
    //}else 
   // if($user instanceof ROLE_ESTUDIANTE) {
   //     return new RedirectResponse($this->urlGenerator->generate('app_estudiante_index'));
   // }
//}
  //  else {
   // return new RedirectResponse($this->urlGenerator->generate('app_login'))
    
//}
//}      
        
}              

           

            //return new RedirectResponse($this->urlGenerator->generate('app_login'));
            //throw new \Exception('TODO: provide a valid redirect inside '.__FILE__);
       // }

        // For example:
        //return new RedirectResponse($this->urlGenerator->generate('app_user_index'));
        
   

    protected function getLoginUrl(Request $request): string
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }
 }
