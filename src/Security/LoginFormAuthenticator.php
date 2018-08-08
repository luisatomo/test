<?php
namespace App\Security;

use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use App\Form\Type\LoginType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class LoginFormAuthenticator extends AbstractFormLoginAuthenticator{
	private $router;
	private $em;
	private $formFactory;
	private $passwordEncoder;
	use TargetPathTrait;
/*private $em;
	private $formFactory;
	private $router;
	private $usermanager;
	private $passwordEncoder;
	private $csrfTokenManager;
	private $session;
	public function __construct(EntityManagerInterface $em, FormFactoryInterface $formFactory, RouterInterface $router, UserManagerInterface $usermanager, UserPasswordEncoder $passwordEncoder, CsrfTokenManagerInterface $csrfTokenManager, SessionInterface $session) {
		$this->em = $em;
		$this->formFactory = $formFactory;
		$this->router = $router;
		$this->usermanager = $usermanager;
		$this->passwordEncoder = $passwordEncoder;
		$this->csrfTokenManager = $csrfTokenManager;
		$this->session = $session;
	}*/
	
	public function __construct(FormFactoryInterface $formFactory, EntityManagerInterface $em, RouterInterface $router, UserPasswordEncoderInterface $passwordEncoder)
	{
		$this->em=$em;
		$this->router = $router;
		$this->formFactory=$formFactory;
		$this->passwordEncoder=$passwordEncoder;
	}
	public function getCredentials(Request $request) {
		
		 $form = $this->formFactory->create ( LoginType::class );
		 $form->handleRequest ( $request );
$data = $form->getData();

        
        
		 
	
		return $data;
	}
	public function getUser($credentials, UserProviderInterface $userProvider) {
		$username = $credentials ['_username'];
		return $this->em->getRepository('App:User')
		->findOneBy(['username' => $username]);
	}
	public function checkCredentials($credentials, UserInterface $user) {
		$password = $credentials ['_password'];
		if ($this->passwordEncoder->isPasswordValid ( $user, $password )) {
		//if ($password == 'iliketurtles') {
			return true;
		}
	
		return false;
	}
	
	public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey) {
		$targetPath = null;
		$em=$this->em;
		$user=$token->getUser();
		$user->setFailcount(0);
		$em->persist($user);
		$em->flush();
	
		// if the user hit a secure page and start() was called, this was
		// the URL they were on, and probably where you want to redirect to
		$targetPath = $this->getTargetPath ( $request->getSession (), $providerKey );
	
		if (! $targetPath) {
			$targetPath = $this->router->generate ( 'backend' );
		}
	
		return new RedirectResponse ( $targetPath );
	}
	protected function getLoginUrl() {
		return $this->router->generate ( 'login' );
	}
	public function onAuthenticationFailure(Request $request, AuthenticationException $exception) {
		//$token = $exception->getToken ();
		$request->getSession()->getFlashBag ()->set(
				'danger', strtr ( $exception->getMessageKey (), $exception->getMessageData () )
				);
		$username = trim($request->request->get ( '_username' ));
		$em = $this->em;
		// $request = $this->request->getCurrentRequest();
		$ip = $request->getClientIp ();
		$now = new \DateTime ();
		$user = $em->getRepository ( 'App:User' )->findOneBy ( array (
				'username' => $username
		) );
		$arraynumber = array (
				0 => '0',
				1 => 'one',
				2 => 'two',
				3 => 'three',
				4 => 'four',
				5 => 'five'
		);
		if ($user) {
				
			if ($user->getFaildate () && ($user->getFaildate ()->getTimestamp () > strtotime ( "-30 minutes" ))) {
				if ($user->getFailcount () >= 4)
					$user->setLocked ( true );
					$user->setFailCount ( $user->getFailcount () + 1 );
					$user->setFaildate ( $now );
					$user->setIpfail ( $ip );
					$em->persist ( $user );
					$em->flush ();
			} else {
				$user->setLocked ( false );
				$user->setFailCount ( 1 );
				$user->setFaildate ( $now );
				$user->setIpfail ( $ip );
				$em->persist ( $user );
				$em->flush ();
			}
			$faileft = 5;
			$failcount = $user->getFailCount ();
			$faileft = 5 - $failcount;
			$tries = 'tries';
			if ($faileft === 1)
				$tries = 'try';
				$stnumber = $arraynumber [$faileft];
				if (! $user->isAccountNonLocked ()) {
					$request->getSession()->getFlashBag ()->set ( 'danger', 'Your account is locked because of too many failed login attempts, please wait 30 minutes before trying again.' );
				} else {
					$request->getSession()->getFlashBag ()->set ( 'warning', 'Warning: Incorrect password. Please try again. You have ' . $stnumber . ' ' . $tries . ' left before your account is locked for 30 minutes as a security precaution' );
				}
		}
		return new RedirectResponse ( $this->router->generate ( 'login' ) );
	}
	
	public function supports(Request $request){
		
	return $request->getPathInfo () == '/login' && $request->isMethod ( 'POST' );
	}
	
	
	
	
	
}