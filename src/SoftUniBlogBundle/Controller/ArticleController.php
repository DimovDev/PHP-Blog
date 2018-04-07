<?php

namespace SoftUniBlogBundle\Controller;

//use http\Env\Request;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use SoftUniBlogBundle\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SoftUniBlogBundle\Entity\Article; // greshniq article e 4akai malko
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;


class ArticleController extends Controller
{
	/**
	 * @param Request $request
	 *
	 * @Route("/article/create",name="article_create")
	 * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response //tova e skeleta
	 *
	 */
	public function create(Request $request)
{
$aricle=new Article();
$form=$this->createForm(ArticleType::class,$aricle);
$form->handleRequest($request);
if($form->isSubmitted() && $form->isValid()){
	@$aricle->setAuthor($this->getUser());
	$currentDate =  date('Y-m-d', strtotime(date('now')));
	$currentDate = new \DateTime();//4
	$aricle->setDateAdded($currentDate);

	$em=$this->getDoctrine()->getManager();
	$em->persist($aricle);
	$em->flush();


	return $this->redirectToRoute('blog_index');
}
return $this->render('article/create.html.twig',
	array('form'=>$form->createView()));
}

	/**
	 * @Route("/article/{id}",name="article_view")
	 * @param id $
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function viewArticle($id)
{
 $article=$this->getDoctrine()->getRepository(Article::class)
	 ->find($id);
 return $this->render('article/article.html.twig',
	 ['article'=>$article]);
}
}
